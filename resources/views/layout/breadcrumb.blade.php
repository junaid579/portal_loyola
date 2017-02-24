<div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <!-- BEGIN PAGE BAR -->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <?php $keys = array_keys($breadcrumbs);
                $last = end($keys); ?>
                @foreach($breadcrumbs as $breadcrumb => $url )
                    @if($breadcrumb != $last)
                    <li>
                        <a href="{{ $url }}">{{ $breadcrumb }}</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    @else
                    <li>
                        <a href="{{ $url }}">{{ $breadcrumb }}</a>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>
        <h1 class="page-title"> {{ $title }}</h1>