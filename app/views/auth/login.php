<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card">

                <div class="card-header">
                    Login
                </div>

                <div class="card-body">

                    <?php if (isset($_SESSION['flash'])) : ?>

                        <div class="alert alert-danger">

                            <?= $_SESSION['flash']['message']; ?>

                        </div>

                        <?php unset($_SESSION['flash']); ?>

                    <?php endif; ?>

                    <form
                        action="<?= BASEURL; ?>/auth/processLogin"
                        method="POST"
                    >

                        <div class="mb-3">

                            <label>
                                Username
                            </label>

                            <input
                                type="text"
                                name="username"
                                class="form-control"
                                required
                            >

                        </div>

                        <div class="mb-3">

                            <label>
                                Password
                            </label>

                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                required
                            >

                        </div>

                        <button
                            type="submit"
                            class="btn btn-primary w-100"
                        >
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>