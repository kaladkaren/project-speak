
<section id="container" class="">
  <!--header start-->
  <header class="header white-bg">
    <div class="sidebar-toggle-box">
      <i class="fa fa-bars"></i>
    </div>
    <!--logo start-->
    <a href="index.html" class="logo" >RestIgniter<span>CRUD</span></a>
    <!--logo end-->
    <div class="top-nav ">
      <ul class="nav pull-right top-menu">
        <li class="dropdown">
          <a data-toggle="dropdown" class="dropdown-toggle" href="#">
            <!-- <img alt="" src="img/avatar1_small.jpg"> -->
            <span class="username">Welcome back, <?php echo $this->session->userdata('name'); ?></span>
            <b class="caret"></b>
          </a>
          <ul class="dropdown-menu extended logout">
            <li><a href="<?php echo base_url('cms/login/logout') ?>"><i class="fa fa-key"></i> Log Out</a></li>
          </ul>
        </li>

      </ul>
    </div>
  </header>
  <!--header end-->
  <!--sidebar start-->
  <aside>
    <div id="sidebar"  class="nav-collapse ">
      <!-- sidebar menu start-->
      <ul class="sidebar-menu" id="nav-accordion">
        <li>
          <a href="<?php echo base_url('cms') ?>"
            class="<?php echo $this->uri->segment(1) === 'cms' && ($this->uri->segment(2) === null || $this->uri->segment(2) === 'dashboard') ? 'active': ''; ?>">
            <i class="fa fa-dashboard"></i>
            <span>Admin Management</span>
          </a>
        </li>        
        <li>
          <a href="<?php echo base_url('cms/devices') ?>"
            class="<?php echo $this->uri->segment(1) === 'cms' && ($this->uri->segment(2) === 'devices') ? 'active': ''; ?>">
            <i class="fa fa-laptop"></i>
            <span>Devices &lt;--&gt; Station Assignment</span>
          </a>
        </li>
        <li>
          <a href="<?php echo base_url('cms/stations') ?>"
            class="<?php echo $this->uri->segment(1) === 'cms' && ($this->uri->segment(2) === 'stations') ? 'active': ''; ?>">
            <i class="fa fa-gears"></i>
            <span>Stations</span>
          </a>
        </li>

       <li class="sub-menu">
          <a href="javascript:;" class="<?php echo (in_array($this->uri->segment(2), ['services', 'people', 'experience']))  ? 'active': ''; ?>">
            <i class="fa fa-group"></i>
            <span>Rateables management</span>
          </a>
          <ul class="sub" >
            <li><a <?php echo $this->uri->segment(2) === 'services' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/services') ?>">Services</a></li>
            <li><a <?php echo $this->uri->segment(2) === 'people' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/people') ?>">People</a></li>
            <li><a <?php echo $this->uri->segment(2) === 'experience' ? 'style="color:#ff6c60"': ''; ?> href="<?php echo base_url('cms/experience') ?>">Experience</a></li>
          </ul>
        </li>
      </ul>
      <!-- sidebar menu end-->
    </div>
  </aside>
  <!--sidebar end-->
