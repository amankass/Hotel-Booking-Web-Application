<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/src/download.png">
    <title>Admin Profile</title>

    <!-- External CSS -->
    <link href="https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/Admin.css">

</head>


<body>
    <?php echo view('/Components/Admin_sidebar.php'); ?>
    <section class="Profile">
        <div class="container Profile_Container">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card shadow-sm ">
                        <div class="cover-photo-container position-relative">
                            <!-- Cover Photo -->
                            <img src="<?= base_url('uploads/' . (!empty($cover_photo) ? esc($cover_photo) : 'default-cover.jpg')); ?>"
                                alt="Cover Photo" class="cover-photo w-100"
                                style="height: 200px; object-fit: cover; border-radius: 10px;">
                            <!-- Camera Icon -->
                            <div class="camera-icon position-absolute" style="top: 10px; right: 10px; cursor: pointer;">
                                <i class="fas fa-camera fa-lg text-white"
                                    style="background-color: rgba(0, 0, 0, 0.6); padding: 10px; border-radius: 50%;"></i>
                            </div>
                            <!-- Hidden File Input -->
                            <form action="<?= site_url('/admin/Admin_cover_upload'); ?>" method="post"
                                enctype="multipart/form-data" id="coverUploadForm">
                                <?= csrf_field(); ?>
                                <input type="file" name="cover_photo" id="coverPhotoInput" class="d-none"
                                    accept="image/*" required>
                            </form>
                        </div>

                        <!-- JavaScript for Changing Cover Photo -->
                        <script>
                            document.addEventListener('DOMContentLoaded', () => {
                                const cameraIcon = document.querySelector('.camera-icon');
                                const coverPhotoInput = document.getElementById('coverPhotoInput');

                                // Click event for camera icon
                                cameraIcon.addEventListener('click', () => {
                                    coverPhotoInput.click(); // Open file input dialog
                                });

                                // Automatically submit the form on file selection
                                coverPhotoInput.addEventListener('change', () => {
                                    document.getElementById('coverUploadForm').submit();
                                });
                            });
                        </script>
                        <div class="card-body">
                            <div class="Profile_image">
                                <?php if (!empty($avatar)): ?>
                                    <!-- Display user avatar if available -->
                                    <img src="<?= base_url('uploads/' . esc($avatar)); ?>" alt="User Avatar"
                                        class="rounded-circle img-fluid profile-avatar clickable-profile-picture"
                                        style="width: 150px; height: 150px;">
                                    <!-- User Title and Name Display -->
                                    <h5 class="my-2" style="font-size: 1.5rem; font-weight: 600;">
                                        <?= esc($user['title']) . ' ' . esc($user['first_name']) . ' ' . esc($user['middle_name']); ?>
                                    </h5>
                                    <p class="text-muted mb-1" style="margin: 0;">Hotel Admin</p>
                                    <a href="<?= site_url('Admin/edit_profile') ?>" class="btn edit_btn">Edit Profile</a>

                                <?php else: ?>
                                    <!-- Placeholder for avatar when not available -->
                                    <div class="placeholder-profile-picture rounded-circle d-flex align-items-center justify-content-center"
                                        style="width: 100px; height: 100px; background-color: #f0f0f0; cursor: pointer;">
                                        <i class="fas fa-user-circle fa-3x animated rotate-infinite"></i>
                                    </div>
                                <?php endif; ?>

                                <!-- Hidden file input for avatar upload -->
                                <form action="<?= site_url('/Admin/admin_upload'); ?>" method="post"
                                    enctype="multipart/form-data" id="profileUploadForm">
                                    <?= csrf_field(); ?>
                                    <input type="file" name="avatar" id="avatarInput" class="d-none" accept="image/*"
                                        required>
                                </form>
                            </div>

                            <!-- JavaScript for Avatar Upload -->
                            <script>
                                document.addEventListener('DOMContentLoaded', () => {
                                    const avatarInput = document.getElementById('avatarInput');
                                    const profilePicture = document.querySelector('.clickable-profile-picture');
                                    const placeholder = document.querySelector('.placeholder-profile-picture');

                                    // Click event for profile picture or placeholder
                                    [profilePicture, placeholder].forEach(element => {
                                        if (element) {
                                            element.addEventListener('click', () => avatarInput.click());
                                        }
                                    });

                                    // Automatically submit the form on file selection
                                    avatarInput.addEventListener('change', () => {
                                        document.getElementById('profileUploadForm').submit();
                                    });
                                });
                            </script>
                            <!-- Add the Update Profile Section -->
                            <div class="profile_form2">
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">Email</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['email']); ?></p>
                                        <!-- Displaying email -->
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">Phone</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['phone']); ?></p>
                                        <!-- Displaying phone -->
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">Gender</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['Gender']); ?></p>
                                        <!-- Displaying Gender -->
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">BirthDate</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['date_of_birth']); ?></p>
                                        <!-- Displaying date_of_birth -->
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">Nationality</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['nationality']); ?></p>
                                        <!-- Displaying nationality -->
                                    </div>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">Country</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['country']); ?></p>
                                        <!-- Displaying Country -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">City</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['city']); ?></p>
                                        <!-- Displaying city -->
                                    </div>
                                </div>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-3">
                                        <p class="mb-0 fw-bold">State</p>
                                    </div>
                                    <div class="col-sm-9">
                                        <p class="text-muted mb-0"><?= esc($user['state']); ?></p>
                                        <!-- Displaying Country -->
                                    </div>
                                </div>
                                <hr>
                                <!-- Hidden User ID -->
                                <input type="hidden" name="id" value="<?= esc($user['id']); ?>">
                            </div>
                        </div>
    </section>
</body>

</html>