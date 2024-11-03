<!DOCTYPE html>
<html lang="en">
@component("dashboard.modules.head")@endcomponent
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo logo-container">
                  <img src="<?=ASSETS?>/images/logo.svg">
                </div>
                <h4>Benvenuto alla dashboard</h4>
                <h6 class="font-weight-light">Per continuare accedi</h6>
                <form class="pt-3" method="POST">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="mt-3 d-grid gap-2">
                    <button type="submit" class="btn btn btn-inverse-info btn-fw">LOG IN</button>
                    </button>
                  </div>
                </form>
                <label style="margin-top: 0.7rem"> {{$error}} </label>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    @component("dashboard.modules.scripts")@endcomponent
    <!-- endinject -->
  </body>
</html>