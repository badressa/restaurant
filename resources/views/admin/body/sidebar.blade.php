@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();

@endphp


<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="#"><img src="{{ asset('frontend/yami/images/logo.png') }}" alt="Logo" srcset="" style="height: 1.5em;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
          </div>
          <div class="sidebar-menu">
              <ul class="menu">
                  <li class="sidebar-title">Menu</li>
                  
                  <li
                      class="sidebar-item {{ ($route == 'dashboard') ? 'active' : '' }} ">
                      <a href="{{ route('dashboard') }}" class='sidebar-link'>
                          <i class="bi bi-grid-fill"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>

                  <li
                      class="sidebar-item  ">
                      <a href="{{ route('restaurant.view') }}" class='sidebar-link {{ ($prefix == '/restaurant') ?'active': '' }}'>
                          <i class="bi bi-grid-fill"></i>
                          <span>restaurant</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item {{ ($prefix == '/staff') ?'active': '' }} has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-stack"></i>
                          <span>Les personelles</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item  ">
                              <a href="{{ route('staff.view') }}">Montrer les peronelles</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="{{ route('staff.add') }}">ajouter un employé</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li
                      class="sidebar-item {{ ($prefix == '/ingredient') ?'active': '' }} has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-stack"></i>
                          <span>Ingredient</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item  ">
                              <a href="{{ route('ingrediant.view') }}">Montrer les ingredients</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="{{ route('ingrediant.add') }}">ajouter un ingredient</a>
                          </li>
                      </ul>
                  </li>

                  <li
                      class="sidebar-item {{ ($prefix == '/recette') ? 'active' : '' }} has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-stack"></i>
                          <span>Recettes</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item  ">
                              <a href="{{ route('recette.view') }}">Montrer les recettes </a>
                          </li>
                          <li class="submenu-item ">
                              <a href="{{ route('recette.add') }}">ajouter les recettes</a>
                          </li>
                          <li class="submenu-item ">
                            <a href="{{ route('recette.category.view') }}">catégories</a>
                        </li>
                      </ul>
                  </li>

                  {{-- boisson comme recette avec ingrediants specifier comme sucre crème  --}}

                  <li
                      class="sidebar-item  ">
                      <a href="{{ route('menu.view') }}" class='sidebar-link'>
                          <i class="bi bi-grid-fill"></i>
                          <span>menu</span>
                      </a>
                  </li>

                  <li
                      class="sidebar-item  ">
                      <a href="{{ route('table.view') }}" class='sidebar-link'>
                          <i class="bi bi-grid-fill"></i>
                          <span>table</span>
                      </a>
                  </li>

                  <li
                      class="sidebar-item  ">
                      <a href="{{ route('reservation.view') }}" class='sidebar-link'>
                          <i class="bi bi-grid-fill"></i>
                          <span>reservation</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-collection-fill"></i>
                          <span>Extra Components</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="extra-component-avatar.html">Avatar</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="extra-component-sweetalert.html">Sweet Alert</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="extra-component-toastify.html">Toastify</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="extra-component-rating.html">Rating</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="extra-component-divider.html">Divider</a>
                          </li>
                      </ul>
                  </li>
                  
                  {{-- <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-grid-1x2-fill"></i>
                          <span>Layouts</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="layout-default.html">Default Layout</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="layout-vertical-1-column.html">1 Column</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="layout-vertical-navbar.html">Vertical Navbar</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="layout-rtl.html">RTL Layout</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="layout-horizontal.html">Horizontal Menu</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li class="sidebar-title">Forms &amp; Tables</li> --}}
                  
                  {{-- <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-hexagon-fill"></i>
                          <span>Form Elements</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="form-element-input.html">Input</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-element-input-group.html">Input Group</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-element-select.html">Select</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-element-radio.html">Radio</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-element-checkbox.html">Checkbox</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-element-textarea.html">Textarea</a>
                          </li>
                      </ul>
                  </li> --}}
                  
                  {{-- <li
                      class="sidebar-item  ">
                      <a href="form-layout.html" class='sidebar-link'>
                          <i class="bi bi-file-earmark-medical-fill"></i>
                          <span>Form Layout</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-pen-fill"></i>
                          <span>Form Editor</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="form-editor-quill.html">Quill</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-editor-ckeditor.html">CKEditor</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-editor-summernote.html">Summernote</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="form-editor-tinymce.html">TinyMCE</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li
                      class="sidebar-item  ">
                      <a href="table.html" class='sidebar-link'>
                          <i class="bi bi-grid-1x2-fill"></i>
                          <span>Table</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-file-earmark-spreadsheet-fill"></i>
                          <span>Datatables</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="table-datatable.html">Datatable</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="table-datatable-jquery.html">Datatable (jQuery)</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li class="sidebar-title">Extra UI</li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-pentagon-fill"></i>
                          <span>Widgets</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="ui-widgets-chatbox.html">Chatbox</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="ui-widgets-pricing.html">Pricing</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="ui-widgets-todolist.html">To-do List</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-egg-fill"></i>
                          <span>Icons</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="ui-icons-bootstrap-icons.html">Bootstrap Icons </a>
                          </li>
                          <li class="submenu-item ">
                              <a href="ui-icons-fontawesome.html">Fontawesome</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="ui-icons-dripicons.html">Dripicons</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li
                      class="sidebar-item  has-sub">
                      <a href="#" class='sidebar-link'>
                          <i class="bi bi-bar-chart-fill"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="submenu ">
                          <li class="submenu-item ">
                              <a href="ui-chart-chartjs.html">ChartJS</a>
                          </li>
                          <li class="submenu-item ">
                              <a href="ui-chart-apexcharts.html">Apexcharts</a>
                          </li>
                      </ul>
                  </li>
                  
                  <li class="sidebar-title">Pages</li>
                  
                  <li
                      class="sidebar-item  ">
                      <a href="application-email.html" class='sidebar-link'>
                          <i class="bi bi-envelope-fill"></i>
                          <span>Email Application</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  ">
                      <a href="application-chat.html" class='sidebar-link'>
                          <i class="bi bi-chat-dots-fill"></i>
                          <span>Chat Application</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  ">
                      <a href="application-gallery.html" class='sidebar-link'>
                          <i class="bi bi-image-fill"></i>
                          <span>Photo Gallery</span>
                      </a>
                  </li>
                  
                  <li
                      class="sidebar-item  ">
                      <a href="application-checkout.html" class='sidebar-link'>
                          <i class="bi bi-basket-fill"></i>
                          <span>Checkout Page</span>
                      </a>
                  </li> --}}
                  
                 
                  
                  
                  
         
                  
                
                  
                 

                  
              </ul>
          </div>
    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
  </div>
</div>