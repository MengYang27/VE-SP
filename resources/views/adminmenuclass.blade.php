@if(Request::is('cmsmgt'))
    @php
     $mainclass = 'basicmgt';   
     $subclass  = 'cmsmgt';    
    @endphp
@elseif(Request::is('home'))
    @php
     $mainclass = 'dashboard';   
     $subclass  = 'home';    
    @endphp
@else
    @php
     $mainclass = 'dashboard';   
     $subclass  = 'home';    
    @endphp    
@endif
