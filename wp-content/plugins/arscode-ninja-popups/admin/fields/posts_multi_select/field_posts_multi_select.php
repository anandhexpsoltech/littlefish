<?php

class SNP_NHP_Options_posts_multi_select extends SNP_NHP_Options
{	
	public function __construct($field = array(), $value ='', $parent)
	{
		parent::__construct($parent->sections, $parent->args, $parent->extra_tabs);
		
		$this->field = $field;
		$this->value = $value;	
	}

	public function render()
	{
		$class = (isset($this->field['class'])) ? 'class="'.$this->field['class'].'" ' : '';
		
		echo '<select id="'.$this->field['id'].'" name="'.$this->args['opt_name'].'['.$this->field['id'].'][]" '.$class.'multiple="multiple" >';

		$args = wp_parse_args($this->field['args'], array('numberposts' => '-1'));
		
		$posts = get_posts($args); 
		foreach ( $posts as $post ) {
			$selected = (is_array($this->value) && in_array($post->ID, $this->value))?' selected="selected"':'';
			echo '<option value="'.$post->ID.'"'.$selected.'>'.$post->post_title.'</option>';
		}

		echo '</select>';

		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">'.$this->field['desc'].'</span>' : '';
		
	}	
}