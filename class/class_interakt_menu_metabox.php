<?php
if ( !class_exists('interakt_menu_metabox')) {
    class interakt_menu_metabox {
        public function add_nav_menu_meta_boxes() {
          add_meta_box(
            'interakt_menu_meta_box',
            __('Interakt'),
            array( $this, 'nav_menu_link'),
            'nav-menus',
            'side',
            'low'
          );
        }
        
        public function nav_menu_link() {?>

          <div id="interakt-menu-options" class="interakt-menu-options">
            <div id="tabs-panel-interakt-menu" class="tabs-panel tabs-panel-active">
              <ul id ="interakt-checklist" class="categorychecklist form-no-clear">
                <li>
                  <label class="menu-item-title">
                    <input type="checkbox" class="menu-item-checkbox" name="menu-item[-1][menu-item-object-id]" value="-1"> Feedback 
                  </label>
                  <input type="hidden" class="menu-item-type" name="menu-item[-1][menu-item-type]" value="category">
                  <input type="hidden" class="menu-item-title" name="menu-item[-1][menu-item-title]" value="Feedback">
                  <input type="hidden" class="menu-item-classes" name="menu-item[-1][menu-item-classes]" value="interaktfeedbackclass" disabled>
                </li>  
                
                 <li>
                  <label class="menu-item-title">
                    <input type="checkbox" class="menu-item-checkbox" name="menu-item[-2][menu-item-object-id]" value="-1"> Chat 
                  </label>
                  <input type="hidden" class="menu-item-type" name="menu-item[-2][menu-item-type]" value="category">
                  <input type="hidden" class="menu-item-title" name="menu-item[-2][menu-item-title]" value="Chat">
                  <input type="hidden" class="menu-item-classes" name="menu-item[-2][menu-item-classes]" value="interaktchatclass" disabled>
                </li>      
              </ul>
            </div>
            <p class="button-controls">
              <span class="list-controls">
                <a href="/wordpress/wp-admin/nav-menus.php?page-tab=all&amp;selectall=1#interakt-menu-options" class="select-all">Select All</a>
              </span> 
              <span class="add-to-menu">
                <input type="submit" class="button-secondary submit-add-to-menu right" value="Add to Menu" name="add-post-type-menu-item" id="submit-interakt-menu-options">
                <span class="spinner"></span>
              </span>
            </p>
          </div>
        <?php
      }
    }   
}
$custom_nav = new interakt_menu_metabox;
add_action('admin_init', array($custom_nav, 'add_nav_menu_meta_boxes'));
?>