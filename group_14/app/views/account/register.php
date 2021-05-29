<div class="container">
    <div class=row align-items-center>
        <div class="col align-self-center">
            <form method="post" action="">
                <div class="mb-3">
                    <label for="account" class="form-label">Account</label>
                    <input type="text" class="form-control" name="account" ></input>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password"></input>
                </div>
                <input type="submit" class="btn btn-primary"></input>
            </form>
            <p><?php echo $oktext ?></p>
        </div>
    </div>
</div>