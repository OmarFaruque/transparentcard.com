<?php
/**
 * Manage inodes from backend to server for customer design 
 */
require_once NBDESIGNER_PLUGIN_DIR . 'includes/class.nbdesigner.pagination.php';


 class COOL_Pagination extends Nbdesigner_Pagination{
    function html() {
        $p = '';
        if ($this->_config['total_record'] > $this->_config['limit']) {
            $p = '<span class="pagination-links omarf">';
            if ($this->_config['current_page'] > 1) {
                $p .= '<a class="prev-page" href="' . $this->pglink('1') . '"><span aria-hidden="true">&#8810;</span></a>';
                $p .= '<a class="prev-page" href="' . $this->pglink($this->_config['current_page'] - 1) . '">&lt;</a>';
            }
            $min = ($this->_config['current_page'] > 2) ? ($this->_config['current_page'] - 2) : 1;
            $max = ($this->_config['current_page'] < ($this->_config['total_page'] - 2)) ? ($this->_config['current_page'] + 2) : $this->_config['total_page'];
            for ($i = $min; $i <= $max; $i++) {
                if ($this->_config['current_page'] == $i) {
                    $p .= '<span class="tablenav-pages-navspan" aria-hidden="true">' . $i . '</span>';
                } else {
                    $p .= '<a class="prev-page" href="' . $this->pglink($i) . '">' . $i . '</a>';
                }
            }
            if ($this->_config['current_page'] < $this->_config['total_page']) {
                $p .= '<a class="next-page" href="' . $this->pglink($this->_config['current_page'] + 1) . '">&gt;</a>';
                $p .= '<a class="next-page" href="' . $this->pglink($this->_config['total_page']) . '">&#8811;</a>';    
            }
            $p .= '</span>';
            return $p;
        }
    }

    private function pglink($page) {
        
        parse_str($_SERVER['QUERY_STRING'], $queryParams);

        if ($page <= 1 && $this->_config['link_first']) {
             return add_query_arg(
                $queryParams,
                $this->_config['link_first'] );   
        }

        return add_query_arg(
            $queryParams,
            str_replace('{p}', $page, $this->_config['link_full']) );   
    }
 }