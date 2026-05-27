<div class="container-xl px-4 mt-4">
    <div class="row">
        <div class="col-xl-8">
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form method="post">
                        <div class="row gx-3 mb-3">
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputlogin">Login</label>
                                <input class="form-control" id="inputlogin" type="text" name="login" required />
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputpass">Password</label>
                                <input class="form-control" id="inputpass" type="password" name="password" required />
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small mb-1">Role</label>
                            <select class="form-select" name="role" required>
                                <option selected disabled>Select a role:</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                                <option value="ipsoshnik">Ipsoshnik</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Add user</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
