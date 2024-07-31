<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 align-items-center">
            <div class="col-sm-6">
                <h1 class="m-0">@yield('title')</h1>
            </div><!-- /.col -->
            <div class="col-sm-6 text-right">
                <!-- You can add breadcrumbs or additional buttons here -->
                @yield('breadcrumb')
            </div><!-- /.col -->
        </div><!-- /.row -->
        <div class="row">
            <div class="col-12">
                <!-- Optional description or subheader -->
                @yield('subheader')
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div><!-- /.content-header -->

<style>
    .content-header {
        background-color: #f8f9fa;
        padding: 20px 0;
        border-bottom: 1px solid #dee2e6;
    }
    .content-header h1 {
        font-size: 2rem;
        font-weight: 600;
        color: #343a40;
    }
    .content-header .breadcrumb {
        background: transparent;
        margin-bottom: 0;
        padding: 0;
    }
    .content-header .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
</style>
