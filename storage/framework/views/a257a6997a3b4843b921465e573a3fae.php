<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
        <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>
        <a href="<?php echo e(route('index')); ?>" class="sidebar-logo">
            <img src="<?php echo e(asset('assets/images/logo.png')); ?>" alt="site logo" class="light-logo">
            <img src="<?php echo e(asset('assets/images/logo-light.png')); ?>" alt="site logo" class="dark-logo">
            <img src="<?php echo e(asset('assets/images/logo-icon.png')); ?>" alt="site logo" class="logo-icon">
        </a>
    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('index')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> AI</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index2')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> CRM</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index3')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> eCommerce</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index4')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Cryptocurrency</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index5')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Investment</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index6')); ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> LMS</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index7')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> NFT & Gaming</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index8')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Medical</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index9')); ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Analytics</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('index10')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> POS & Inventory </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar-menu-group-title">Application</li>
            <li>
                  <a href="<?php echo e(route('email')); ?>">
                    <iconify-icon icon="mage:email" class="menu-icon"></iconify-icon>
                    <span>Email</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('chatMessage')); ?>">
                    <iconify-icon icon="bi:chat-dots" class="menu-icon"></iconify-icon>
                    <span>Chat</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('calendar')); ?>">
                    <iconify-icon icon="solar:calendar-outline" class="menu-icon"></iconify-icon>
                    <span>Calendar</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('kanban')); ?>">
                    <iconify-icon icon="material-symbols:map-outline" class="menu-icon"></iconify-icon>
                    <span>Kanban</span>
                </a>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="hugeicons:invoice-03" class="menu-icon"></iconify-icon>
                    <span>Invoice</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                    <a href="<?php echo e(route('invoiceList')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> List</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('invoicePreview')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Preview</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('invoiceAdd')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add new</a>
                    </li>
                    <li>
                    <a href="<?php echo e(route('invoiceEdit')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Edit</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <i class="ri-robot-2-line text-xl me-6 d-flex w-auto"></i>
                    <span>Ai Application</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('textGenerator')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Text Generator</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('codeGenerator')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Code Generator</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('imageGenerator')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Image Generator</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('voiceGenerator')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Voice Generator</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('videoGenerator')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Video Generator</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <i class="ri-btc-line text-xl me-6 d-flex w-auto"></i>
                    <span>Crypto Currency</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="<?php echo e(route('wallet')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Wallet</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('marketplace')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Marketplace</a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('marketplaceDetails')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Marketplace Details</a>
                    </li>
                    <li>
                    <a  href="<?php echo e(route('portfolio')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Portfolios</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">UI Elements</li>

            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="solar:document-text-outline" class="menu-icon"></iconify-icon>
                    <span>Components</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('typography')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Typography</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('colors')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Colors</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('button')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Button</a>
                    </li>
                    <li>
                         <a  href="<?php echo e(route('dropdown')); ?>"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Dropdown</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('alert')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Alerts</a>
                    </li>
                    <li>
                       <a  href="<?php echo e(route('card')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Card</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('carousel')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Carousel</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('avatar')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Avatars</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('progress')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Progress bar</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('tabs')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Tab & Accordion</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('pagination')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Pagination</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('badges')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Badges</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('tooltip')); ?>"><i class="ri-circle-fill circle-icon text-lilac-600 w-auto"></i> Tooltip & Popover</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('videos')); ?>"><i class="ri-circle-fill circle-icon text-cyan w-auto"></i> Videos</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('starRating')); ?>"><i class="ri-circle-fill circle-icon text-indigo w-auto"></i> Star Ratings</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('tags')); ?>"><i class="ri-circle-fill circle-icon text-purple w-auto"></i> Tags</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('list')); ?>"><i class="ri-circle-fill circle-icon text-red w-auto"></i> List</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('calendar')); ?>"><i class="ri-circle-fill circle-icon text-yellow w-auto"></i> Calendar</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('radio')); ?>"><i class="ri-circle-fill circle-icon text-orange w-auto"></i> Radio</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('switch')); ?>"><i class="ri-circle-fill circle-icon text-pink w-auto"></i> Switch</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('imageUpload')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Upload</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="heroicons:document" class="menu-icon"></iconify-icon>
                    <span>Forms</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('form')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Input Forms</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('formLayout')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Input Layout</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('formValidation')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Form Validation</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('wizard')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Form Wizard</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="mingcute:storage-line" class="menu-icon"></iconify-icon>
                    <span>Table</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('tableBasic')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Basic Table</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('tableData')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Data Table</a>
                    </li>
                </ul>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="solar:pie-chart-outline" class="menu-icon"></iconify-icon>
                    <span>Chart</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('lineChart')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Line Chart</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('columnChart')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Column Chart</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('pieChart')); ?>"><i class="ri-circle-fill circle-icon text-success-main w-auto"></i> Pie Chart</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="<?php echo e(route('widgets')); ?>">
                    <iconify-icon icon="fe:vector" class="menu-icon"></iconify-icon>
                    <span>Widgets</span>
                </a>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="flowbite:users-group-outline" class="menu-icon"></iconify-icon>
                    <span>Users</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('usersList')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Users List</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('usersGrid')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Users Grid</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('addUser')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add User</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('viewProfile')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> View Profile</a>
                    </li>
                </ul>
            </li>

            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <i class="ri-user-settings-line text-xl me-6 d-flex w-auto"></i>
                    <span>Role & Access</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('roleAaccess')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Role & Access</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('assignRole')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Assign Role</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-menu-group-title">Application</li>

            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="simple-line-icons:vector" class="menu-icon"></iconify-icon>
                    <span>Authentication</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('signin')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Sign In</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('signup')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Sign Up</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('forgotPassword')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Forgot Password</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="<?php echo e(route('gallery')); ?>">
                    <iconify-icon icon="solar:gallery-wide-linear" class="menu-icon"></iconify-icon>
                    <span>Gallery</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('pricing')); ?>">
                    <iconify-icon icon="hugeicons:money-send-square" class="menu-icon"></iconify-icon>
                    <span>Pricing</span>
                </a>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <i class="ri-news-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blog</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('blog')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Blog</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('blogDetails')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Blog Details</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('addBlog')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Add Blog</a>
                    </li>
                </ul>
            </li>
            <li>
                <a  href="<?php echo e(route('testimonials')); ?>">
                    <i class="ri-star-line text-xl me-6 d-flex w-auto"></i>
                    <span>Testimonial</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('faq')); ?>">
                    <iconify-icon icon="mage:message-question-mark-round" class="menu-icon"></iconify-icon>
                    <span>FAQs</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('error')); ?>">
                    <iconify-icon icon="streamline:straight-face" class="menu-icon"></iconify-icon>
                    <span>404</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('termsCondition')); ?>">
                    <iconify-icon icon="octicon:info-24" class="menu-icon"></iconify-icon>
                    <span>Terms & Conditions</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('comingSoon')); ?>">
                    <i class="ri-rocket-line text-xl me-6 d-flex w-auto"></i>
                    <span>Coming Soon</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('maintenance')); ?>">
                    <i class="ri-hammer-line text-xl me-6 d-flex w-auto"></i>
                    <span>Maintenance</span>
                </a>
            </li>
            <li>
                <a  href="<?php echo e(route('blankPage')); ?>">
                    <i class="ri-checkbox-multiple-blank-line text-xl me-6 d-flex w-auto"></i>
                    <span>Blank Page</span>
                </a>
            </li>
            <li class="dropdown">
                <a  href="javascript:void(0)">
                    <iconify-icon icon="icon-park-outline:setting-two" class="menu-icon"></iconify-icon>
                    <span>Settings</span>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a  href="<?php echo e(route('company')); ?>"><i class="ri-circle-fill circle-icon text-primary-600 w-auto"></i> Company</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('notification')); ?>"><i class="ri-circle-fill circle-icon text-warning-main w-auto"></i> Notification</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('notificationAlert')); ?>"><i class="ri-circle-fill circle-icon text-info-main w-auto"></i> Notification Alert</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('theme')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Theme</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('currencies')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Currencies</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('language')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Languages</a>
                    </li>
                    <li>
                        <a  href="<?php echo e(route('paymentGateway')); ?>"><i class="ri-circle-fill circle-icon text-danger-main w-auto"></i> Payment Gateway</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</aside><?php /**PATH E:\Laravel\wowdash - 2\resources\views/components/sidebar.blade.php ENDPATH**/ ?>