<?php
session_start();
// Check if user is admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    header("Location: index.php");
    exit;
}

require_once '../config/db_connect.php';

// Fetch genres
$genres_result = $conn->query("SELECT * FROM genres ORDER BY genre_name");
$genres = [];
if ($genres_result) {
    while ($row = $genres_result->fetch_assoc()) {
        $genres[] = $row;
    }
}

// Fetch tags
$tags_result = $conn->query("SELECT * FROM tags ORDER BY tag_name");
$tags = [];
if ($tags_result) {
    while ($row = $tags_result->fetch_assoc()) {
        $tags[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Game - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background-color: #1b2838;
            color: #c7d5e0;
        }
        .form-container {
            background-color: #171a21;
            padding: 30px;
            border-radius: 5px;
            margin-top: 30px;
            margin-bottom: 50px;
        }
        .form-label {
            color: #66c0f4;
            font-weight: bold;
        }
        .form-control, .form-select {
            background-color: #2a475e;
            border: 1px solid #000;
            color: #fff;
        }
        .form-control:focus {
            background-color: #2a475e;
            color: #fff;
            border-color: #66c0f4;
            box-shadow: 0 0 5px rgba(102, 192, 244, 0.5);
        }
        .section-title {
            border-bottom: 1px solid #3e6c96;
            padding-bottom: 10px;
            margin-bottom: 20px;
            margin-top: 30px;
            color: #fff;
        }
        .checkbox-group {
            max-height: 200px;
            overflow-y: auto;
            background: #2a475e;
            padding: 10px;
            border-radius: 4px;
        }
        .form-check-input:checked {
            background-color: #66c0f4;
            border-color: #66c0f4;
        }
    </style>
</head>
<body>

    <?php include 'navbar_include.php'; ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="form-container">
                    <h2 class="mb-4 text-white"><i class="fas fa-plus-circle me-2"></i>Add New Game</h2>
                    
                    <form action="../php_backend/add_game_process.php" method="POST" enctype="multipart/form-data">
                        
                        <!-- Basic Information -->
                        <h4 class="section-title">Basic Information</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="title" class="form-label">Game Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="col-md-6">
                                <label for="developer" class="form-label">Developer</label>
                                <input type="text" class="form-control" id="developer" name="developer" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" min="0" required>
                            </div>
                            <div class="col-md-6">
                                <label for="release_date" class="form-label">Release Date</label>
                                <input type="date" class="form-control" id="release_date" name="release_date" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                        </div>

                        <!-- Images -->
                        <h4 class="section-title">Images</h4>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="header_image" class="form-label">Header Image URL</label>
                                <input type="text" class="form-control" id="header_image" name="header_image" placeholder="assets/images/..." required>
                            </div>
                            <div class="col-md-6">
                                <label for="thumbnail_image" class="form-label">Thumbnail Image URL</label>
                                <input type="text" class="form-control" id="thumbnail_image" name="thumbnail_image" placeholder="assets/images/..." required>
                            </div>
                        </div>

                        <!-- System Requirements -->
                        <h4 class="section-title">System Requirements</h4>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-white mb-3">Minimum</h5>
                                <div class="mb-2">
                                    <label class="form-label small">OS</label>
                                    <input type="text" class="form-control form-control-sm" name="min_os" placeholder="e.g. Windows 10">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Processor</label>
                                    <input type="text" class="form-control form-control-sm" name="min_processor" placeholder="e.g. Intel Core i5">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Memory</label>
                                    <input type="text" class="form-control form-control-sm" name="min_memory" placeholder="e.g. 8 GB RAM">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Graphics</label>
                                    <input type="text" class="form-control form-control-sm" name="min_graphics" placeholder="e.g. NVIDIA GTX 1060">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">DirectX</label>
                                    <input type="text" class="form-control form-control-sm" name="min_directx" placeholder="e.g. Version 11">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Storage</label>
                                    <input type="text" class="form-control form-control-sm" name="min_storage" placeholder="e.g. 50 GB available space">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <h5 class="text-white mb-3">Recommended</h5>
                                <div class="mb-2">
                                    <label class="form-label small">OS</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_os">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Processor</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_processor">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Memory</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_memory">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Graphics</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_graphics">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">DirectX</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_directx">
                                </div>
                                <div class="mb-2">
                                    <label class="form-label small">Storage</label>
                                    <input type="text" class="form-control form-control-sm" name="rec_storage">
                                </div>
                            </div>
                        </div>

                        <!-- Genres & Tags -->
                        <h4 class="section-title">Categorization</h4>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Genres</label>
                                <div class="checkbox-group">
                                    <?php foreach ($genres as $genre): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="genres[]" value="<?php echo $genre['genre_id']; ?>" id="genre_<?php echo $genre['genre_id']; ?>">
                                            <label class="form-check-label text-white" for="genre_<?php echo $genre['genre_id']; ?>">
                                                <?php echo htmlspecialchars($genre['genre_name']); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tags</label>
                                <div class="checkbox-group">
                                    <?php foreach ($tags as $tag): ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="tags[]" value="<?php echo $tag['tag_id']; ?>" id="tag_<?php echo $tag['tag_id']; ?>">
                                            <label class="form-check-label text-white" for="tag_<?php echo $tag['tag_id']; ?>">
                                                <?php echo htmlspecialchars($tag['tag_name']); ?>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Add Game</button>
                            <a href="index.php" class="btn btn-outline-secondary">Cancel</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
