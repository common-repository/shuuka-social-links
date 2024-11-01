<?php

class SHUUKA_PAGE_TEMPLATE
{
    private $name;
    private $file_path;
    private $page_slug;

    public function __construct($name, $page_slug, $file_path)
    {
        $this->name = $name;
        $this->file_path = $file_path;
        $this->page_slug = $page_slug;
    }

    function page_template($page_template)
    {

        if (get_page_template_slug() == $this->page_slug) {
            $page_template = $this->file_path;
        }
        return $page_template;
    }


    function add_template_to_select($post_templates, $wp_theme, $post, $post_type)
    {

        $post_templates[$this->page_slug] = __($this->name);
        return $post_templates;
    }

    public function init()
    {
        //Load template from specific page
        add_filter('page_template', array($this, 'page_template'));


        add_filter('theme_page_templates', array($this, 'add_template_to_select'), 10, 4);

    }
}