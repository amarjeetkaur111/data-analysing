    <div id="slide-out" class="side-nav sn-bg-4 fixed">
      <ul class="custom-scrollbar">

        <!-- Logo -->
        <li class="logo-sn waves-effect py-3">
          <div class="text-center">
            <a href="#" class="pl-0"><img src=""></a>
          </div>
        </li>

        <!-- Search Form -->
        <li>
          <form class="search-form" role="search">
            <div class="md-form mt-0 waves-light">
              <input type="text" class="form-control py-2" placeholder="Search">
            </div>
          </form>
        </li>

        <!-- Side navigation links -->
        <li>
          <ul class="collapsible collapsible-accordion">

            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-user"></i>Administration<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>			
                  <li>
                    <a href="{{ route('users') }}" class="waves-effect">Users & Pharmacy</a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-table"></i>Field Management<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <a href="{{ route('categories') }}" class="waves-effect">Category</a>
                  </li>
                  <li>
                    <a href="{{ route('fields') }}" class="waves-effect">Fields</a>
                  </li>				  
                </ul>
              </div>
            </li>			
            <li>
              <a class="collapsible-header waves-effect arrow-r">
                <i class="w-fa fas fa-table"></i>Dataentry<i class="fas fa-angle-down rotate-icon"></i>
              </a>
              <div class="collapsible-body">
                <ul>
                  <li>
                    <a href="../tables/basic.html" class="waves-effect">Dataentry</a>
                  </li>
                </ul>
              </div>
            </li>

          </ul>
        </li>
        <!-- Side navigation links -->

      </ul>
      <div class="sidenav-bg mask-strong"></div>
    </div>