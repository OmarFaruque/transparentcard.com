<?php
/**
 * Class COOL_Validationemail file.
 *
 * @package WooCommerce\Emails
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'COOL_Validationemail', false ) ) :

	/**
	 * Customer New Account.
	 *
	 * An email sent to the customer when they create an account.
	 *
	 * @class       COOL_Validationemail
	 * @version     3.5.0
	 * @package     WooCommerce\Classes\Emails
	 * @extends     WC_Email
	 */
	class COOL_Validationemail extends WC_Email {

		/**
		 * User login name.
		 *
		 * @var string
		 */
		public $user_login;

		/**
		 * User email.
		 *
		 * @var string
		 */
		public $user_email;

		/**
		 * User password.
		 *
		 * @var string
		 */
		public $user_pass;

		/**
		 * Is the password generated?
		 *
		 * @var bool
		 */
		public $password_generated;

		/**
		 * Magic link to set initial password.
		 *
		 * @var string
		 */
		public $set_password_url;

        /**
         * Valication url for email body
         * @var string
         */
        public $validation_url;

		/**
		 * Constructor.
		 */
		public function __construct() {
			$this->id             = 'customer_email_validation';
			$this->customer_email = true;
			$this->title          = __( 'Email Validation for new registration', 'woocommerce' );
			$this->description    = __( 'Customer "email validation" emails are sent to the customer when a customer signs up via checkout or account pages.', 'woocommerce' );
			$this->template_html  = 'emails/customer-email-validation.php';
			$this->template_plain = 'emails/plain/customer-new-account.php';

			// Call parent constructor.
			parent::__construct();
		}

		/**
		 * Get email subject.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_subject() {
			return __( 'Process your email validation for {site_title}!', 'woocommerce' );
		}

		/**
		 * Get email heading.
		 *
		 * @since  3.1.0
		 * @return string
		 */
		public function get_default_heading() {
			return __( 'Email Verification for {site_title}', 'woocommerce' );
		}

		/**
		 * Trigger.
		 *
		 * @param int    $user_id User ID.
		 * @param string $user_pass User password.
		 */
		public function trigger( $user_id, $validation_url) {


			
			$this->setup_locale();

			if ( $user_id ) {
				$this->object = new WP_User( $user_id );
				$this->user_login         = stripslashes( $this->object->user_login );
				$this->user_email         = stripslashes( $this->object->user_email );
				$this->recipient          = $this->user_email;
                $this->validation_url     = $validation_url;
			}

			if ( $this->is_enabled() && $this->get_recipient() ) {
				$this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );
			}

			$this->restore_locale();
		}

		/**
		 * Get content html.
		 *
		 * @return string
		 */
		public function get_content_html() {
			return wc_get_template_html(
				$this->template_html,
				array(
					'email_heading'      => $this->get_heading(),
					'additional_content' => $this->get_additional_content(),
					'user_login'         => $this->user_login,
					'user_pass'          => $this->user_pass,
					'blogname'           => $this->get_blogname(),
					'sent_to_admin'      => false,
					'plain_text'         => false,
					'email'              => $this,
					'validation_url'   => $this->validation_url,
				)
			);
		}

		/**
		 * Get content plain.
		 *
		 * @return string
		 */
		public function get_content_plain() {
			return wc_get_template_html(
				$this->template_plain,
				array(
					'email_heading'      => $this->get_heading(),
					'additional_content' => $this->get_additional_content(),
					'user_login'         => $this->user_login,
					'user_pass'          => $this->user_pass,
					'blogname'           => $this->get_blogname(),
					'sent_to_admin'      => false,
					'plain_text'         => true,
					'email'              => $this,
					'validation_url'   => $this->validation_url,
				)
			);
		}

		/**
		 * Default content to show below main email content.
		 *
		 * @since 3.7.0
		 * @return string
		 */
		public function get_default_additional_content() {
			return __( 'We look forward to seeing you soon.', 'woocommerce' );
		}

		/**
		 * Generate set password URL link for a new user.
		 * 
		 * See also Automattic\WooCommerce\Blocks\Domain\Services\Email\CustomerNewAccount and wp_new_user_notification.
		 * 
		 * @since 6.0.0
		 * @return string
		 */
		protected function generate_set_password_url() {
			// Generate a magic link so user can set initial password.
			$key = get_password_reset_key( $this->object );
			if ( ! is_wp_error( $key ) ) {
				$action                 = 'newaccount';
				return wc_get_account_endpoint_url( 'lost-password' ) . "?action=$action&key=$key&login=" . rawurlencode( $this->object->user_login );
			} else {
				// Something went wrong while getting the key for new password URL, send customer to the generic password reset.
				return wc_get_account_endpoint_url( 'lost-password' );
			}
		} 
	}

endif;

return new COOL_Validationemail();
