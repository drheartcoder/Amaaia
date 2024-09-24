<!-- HEader -->        
@include('supplier.layout._header')    
        
<!-- BEGIN Sidebar -->
@include('supplier.layout._sidebar')
<!-- END Sidebar -->

<!-- BEGIN Content -->
<div id="main-content">
    @yield('main_content')
</div>
    <!-- END Main Content -->

<!-- Footer -->        
@include('supplier.layout._footer')    
                
              