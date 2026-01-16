<?php include("../../layouts/header-admin.php"); ?>
<main class="app-main">
    <div class="app-content mt-5">
        <div class="container-fluid">
            <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Tambah Pengguna</div>
                </div>
                <form method="post" action="../../handlers/create-user.php" >
                    <!--begin::Body-->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name"
                                aria-describedby="emailHelp" name="name" />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email"
                                aria-describedby="emailHelp" name="email" />
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" id="password" />
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="is_admin" id="is_admin" />
                            <label class="form-check-label" for="is_admin" >Admin</label>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include("../../layouts/footer-admin.php"); ?>