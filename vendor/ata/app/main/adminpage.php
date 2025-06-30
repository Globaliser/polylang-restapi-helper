<?php

namespace PolylangRestapiHelper\ATA;

class AdminPage extends Core
{
  public $controller = null;
  protected $page_title = null;
  protected $menu_title = null;

  protected $call = null;

  protected $permissions = null;

  protected $menu_slug = null;

  protected $menu_icon = 'dashicons-admin-generic';
  protected $position = 99;

  protected $tabs = [];

  protected $run = null;


  public function __construct($title)
  {
    $this->page_title = $title;
    $this->menu_title = $title;
    $this->menu_slug = sanitize_title($title);
  }

  public function init()
  {

    add_action('admin_menu', function () {
      add_menu_page(
        $this->page_title,
        $this->menu_title,
        $this->permissions,
        $this->menu_slug,
        [$this, $this->run],
        $this->menu_icon,
        $this->position
      );
    });
  }

  public function run()
  {
    call_user_func([$this->controller, $this->call]);
    include ATAConfig::$view_path . $this->controller->view . '-view.php';
  }

  public function run_with_tabs()
  {
    $current_tab = current_tab();

    foreach ($this->tabs as $tab)
      if ($tab['tab_slug'] === $current_tab) {
        call_user_func([$this->controller, $tab['call']]);
        break;
      } elseif (isset($tab['sub_tabs'])) {
        foreach ($tab['sub_tabs'] as $sub_tab)
          if ($sub_tab['call'] === $current_tab) {
            call_user_func([$this->controller, $sub_tab['call']]);
            break;
          }
      }
    $ata = $this->controller->ata;

    if ($this->controller->view) $this->controller->ata->tab_view = ATAConfig::$view_path . $this->controller->view . '-view.php';

    $this->controller->ata->tabs = $this->tabs;


    include ATAConfig::$plugin_path . '/vendor/ata/app/views/adminpage-header.php';
    include ATAConfig::$plugin_path . '/vendor/ata/app/views/adminpage-tabs.php';
    include ATAConfig::$plugin_path . '/vendor/ata/app/views/adminpage-footer.php';
  }

  public function menu_title($title)
  {
    $this->menu_title = $title;
    return $this;
  }

  public function permission($permission)
  {
    $this->permissions = $permission;
    return $this;
  }

  public function permissions($permissions)
  {
    foreach ($permissions as $permission) {
      $this->permission($permission);
    }
    return $this;
  }

  public function menu_slug($slug)
  {
    $this->menu_slug = $slug;
    return $this;
  }

  public function add_tab($tab_title, $call = null, $tab_slug = null)
  {
    if ($call === null) $call = str_replace("-", "_", sanitize_title($tab_title));
    if ($tab_slug === null) $tab_slug = sanitize_title($call);

    // First tab's slug should be null
    if (count($this->tabs) === 0) $tab_slug = null;

    $this->tabs[] = ['menu_slug' => $this->menu_slug, 'title' => $tab_title, 'call' => $call, 'tab_slug' => $tab_slug];

    return $this;
  }

  public function add_sub_tab($tab_title, $call = null, $tab_slug = null)
  {

    if ($call === null) $call = str_replace("-", "_", sanitize_title($tab_title));
    if ($tab_slug === null) $tab_slug = sanitize_title($call);


    // First subtab's slug should use the main tab's slug
    if (!isset($this->tabs[count($this->tabs) - 1]['sub_tabs'])) $tab_slug = $this->tabs[count($this->tabs) - 1]['tab_slug'];

    // We set this to easily check subtabs' slugs
    if ($tab_slug !== null) $this->tabs[count($this->tabs) - 1]['sub_tab_slugs'][] = $tab_slug;

    $this->tabs[count($this->tabs) - 1]['sub_tabs'][] = ['title' => $tab_title, 'call' => $call, 'tab_slug' => $tab_slug];

    return $this;
  }

  public function call($call)
  {
    $this->run = 'run';
    $this->call = $call;
    $this->init();
  }
  public function register()
  {
    $this->run = 'run_with_tabs';
    $this->init();
  }
}
