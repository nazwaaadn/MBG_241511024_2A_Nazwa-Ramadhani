
    <div class="container">
        <h2>Form Add Data</h2><br>
        <form action="<?= site_url('/students/store') ?>" method="post">
            <?= csrf_field() ?>

            <div class="mb-3">
                <label for="Student ID" class="form-label">Student ID</label>
                <input type="text" 
                       class="form-control <?= session('errors.student_id') ? 'is-invalid' : '' ?>" 
                       id="Student ID" 
                       name="student_id" 
                       value="<?= old('student_id') ?>">
                <?php if(session('errors.student_id')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.student_id') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Username" class="form-label">Username</label>
                <input type="text" 
                       class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>" 
                       id="Username" 
                       name="username" 
                       value="<?= old('username') ?>">
                <?php if(session('errors.username')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.username') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="Password" class="form-label">Password</label>
                <input type="password" 
                       class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" 
                       id="Password" 
                       name="password" 
                       value="<?= old('password') ?>">
                <?php if(session('errors.password')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.password') ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label for="FullName" class="form-label">Full Name</label>
                <input type="text" 
                       class="form-control <?= session('errors.full_name') ? 'is-invalid' : '' ?>" 
                       id="FullName" 
                       name="full_name" 
                       value="<?= old('full_name') ?>">
                <?php if(session('errors.full_name')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.full_name') ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="mb-3">
                <label for="EntryYear" class="form-label">Entry Year</label>
                <input type="number" 
                       name="entry_year" 
                       class="form-control <?= session('errors.entry_year') ? 'is-invalid' : '' ?>" 
                       id="EntryYear" 
                       value="<?= old('entry_year') ?>">
                <?php if(session('errors.entry_year')): ?>
                    <div class="invalid-feedback">
                        <?= session('errors.entry_year') ?>
                    </div>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>