<div class="modal fade " id="<?php echo 'editmodal' . $cont ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                Edit Post
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="../controllers/myAcount_controller.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                    <label for="recipient-name" class="col-form-label">Title:</label>
                                    <input type="text" class="form-control" id="recipient-name" value="<?php echo $title ?>" name="title" />
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Category:</label>
                                    <select class="form-select form-control" aria-label="Default select example" name="category" value="<?php echo $category ?>">
                                        <option <?php if ($category === 'choose category') {
                                                    echo 'selected';
                                                } ?>>choose category</option>
                                        <option value="Movie" <?php if ($category === 'Movie') {
                                                                    echo 'selected';
                                                                } ?>>Movie</option>
                                        <option value="Serie" <?php if ($category === 'Serie') {
                                                                    echo 'selected';
                                                                } ?>>Serie</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Description:</label>
                                    <textarea type="text" class="form-control" id="message-text" name="description" value=""><?php echo $description ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="recipient-name" class="col-form-label">Add picture:</label>
                                    <input class="form-control" type="file" id="formFile" name="image" accept=".jpg, .jpeg, .png" value="<?php echo $image ?>" />
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-secondary" value="Update" name="submit_update">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <!-- ########################################################################################################################################## -->

            <div class="post">
                <div class="card">
                    <div class="post-profil d-flex ">
                        <div class="profil">
                            <img class="" src="../images/avatar.webp" alt="images" />
                            <a href=""><?php echo  $firstName . ' ' . $lastName; ?></a>
                        </div>
                        <div class="options">
                            <div class="dropdown">
                                <a <?php if ($authorId != $_SESSION['id']) {
                                        echo 'style="display: none;"';
                                    } ?> class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i style="margin-right: 19px; font-size: 30px;" class="fa-solid fa-ellipsis"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                    <li><input style="MARGIN-LEFT: 9%;" type="button" class="btn <?php echo 'editbtn' . $cont ?>" data-bs-toggle="modal" data-bs-target="<?php echo '#editmodal' . $cont ?>" data-bs-whatever="Update" value="Edit" />
                                        <script>
                                            $(document).ready(function() {
                                                $(<?php echo '.editbtn' . $cont ?>).on('click', function() {
                                                    $(<?php echo '#editmodal' . $cont ?>).modal('show');
                                                })
                                            })
                                            $(document).ready(function() {
                                                $(<?php echo '.commentbtn' . $cont ?>).on('click', function() {
                                                    $(<?php echo '#commentmodal' . $cont ?>).modal('show');
                                                })
                                            })
                                        </script>
                                    </li>
                                    <li><a href="../controllers/myAcount_controller.php?delete=<?php echo $postId ?>"><button class="btn">delete</button></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body  pt-0">
                        <div class="modal-content bg-light py-3 px-2">
                            <h4 class="card-title ps-3"><?php echo $title ?></h4>
                            <h6 class="ps-3"><?php echo $category ?></h6>
                            <p class="card-text ps-3">
                                <?php echo $description ?>
                            </p>
                            <img src="<?php echo $image ?>" class="card-img-top" alt="..." />
                        </div>
                        <!-- pop up comment -->
                        <a type="button" class="<?php echo 'commentView' . $cont ?> mt-4 ps-2 " data-bs-toggle="modal" data-bs-target="<?php echo '#commentsModal' . $cont ?>" data-bs-whatever="comments">All Comments</a>
                        <div class="modal fade " id="<?php echo 'commentsModal' . $cont ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">
                                            Comments
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-header">
                                        <div class="modal-content mt-4 bg-light">
                                            <?php
                                            //get acc array 
                                            $getcomments = new Comments();
                                            $commentResult = $getcomments->getComments();
                                            $commentRows = mysqli_fetch_all($commentResult, MYSQLI_ASSOC);
                                            foreach ($commentRows as $comment) {
                                                //set all commnents for this post
                                                if ($comment['postID'] == $postId) {
                                            ?>
                                                    <div class="modal-header">
                                                        <div class="commented-section mt-2 ">
                                                            <div class="d-flex flex-row align-items-center commented-user">
                                                                <div class="profil">
                                                                    <!-- <img class="" src="../images/avatar.webp" alt="images" /> -->
                                                                    <h6 class="mr-2"><?php echo $comment['firstName'] . ' ' . $comment['lastName'] ?></h6>

                                                                </div>
                                                            </div>
                                                            <div class="comment-text-sm"><span><?php echo $comment['comment'] ?></span></div>
                                                        </div>
                                                        <div class="options">
                                                            <div class="dropdown">
                                                                <a <?php if ($authorId != $_SESSION['id']) {
                                                                        echo 'style="display: none;"';
                                                                    } ?> class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                                    <i style="margin-right: 19px; font-size: 25px;" class="fa-solid fa-ellipsis "></i>
                                                                </a>
                                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                    <li><input style="MARGIN-LEFT: 9%;" type="button" class="form-control <?php echo 'editbtn' . $cont ?>" data-bs-toggle="modal" data-bs-target="<?php echo '#editmodal' . $cont ?>" data-bs-whatever="Update" value="Edit" />
                                                                        <script>
                                                                            $(document).ready(function() {
                                                                                $(<?php echo '.editbtn' . $cont ?>).on('click', function() {
                                                                                    $(<?php echo '#editmodal' . $cont ?>).modal('show');
                                                                                })
                                                                            })
                                                                            $(document).ready(function() {
                                                                                $(<?php echo '.commentbtn' . $cont ?>).on('click', function() {
                                                                                    $(<?php echo '#commentmodal' . $cont ?>).modal('show');
                                                                                })
                                                                            })
                                                                        </script>
                                                                    </li>
                                                                    <li><a href="../controllers/myAcount_controller.php?delete=<?php echo $postId ?>"><button class="form-control">delete</button></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php }
                                            } ?>
                                            <form action="../controllers/myAcount_controller.php" method="POST">
                                                <div class="modal-body d-flex">
                                                    <input type="message" placeholder="write a comment..." class="form-control me-3" name="comment" />

                                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                                    <input type="hidden" name="auhorId" value="<?php echo $authorId ?>">
                                                    <input type="submit" class="btn " name="addcomment" value="Add">
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                    <div class="modal-body">
                                        <form action="../controllers/myAcount_controller.php" method="post">

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-content mt-1 bg-light">
                            <?php
                            $ContComment = 0;
                            foreach ($commentRows as $comment) {
                                //set 3 commnents for this post
                                if ($comment['postID'] == $postId && $ContComment < 3) {
                                    $ContComment++; ?>
                                    <div class="modal-header">
                                        <div class="commented-section mt-2 ">
                                            <div class="d-flex flex-row align-items-center commented-user">
                                                <div class="profil">
                                                    <!-- <img class="" src="../images/avatar.webp" alt="images" /> -->
                                                    <h6 class="mr-2"><?php echo $comment['firstName'] . ' ' . $comment['lastName'] ?></h6>

                                                </div>
                                            </div>
                                            <div class="comment-text-sm"><span><?php echo $comment['comment'] ?></span></div>
                                        </div>
                                        <div class="options">
                                            <div class="dropdown">
                                                <a <?php //if ($authorId != $_SESSION['id']) {
                                                    //echo 'style="display: none;"';
                                                    //} 
                                                    ?> class="dropdown-toggle" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i style="margin-right: 19px; font-size: 25px;color:black" class="fa-solid fa-ellipsis "></i>
                                                </a>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <li><input style="MARGIN-LEFT: 9%;" type="button" class="btn <?php echo 'editbtn' . $cont ?>" data-bs-toggle="modal" data-bs-target="<?php echo '#editmodal' . $cont ?>" data-bs-whatever="Update" value="Edit" />
                                                        <script>
                                                            $(document).ready(function() {
                                                                $(<?php echo '.editbtn' . $cont ?>).on('click', function() {
                                                                    $(<?php echo '#editmodal' . $cont ?>).modal('show');
                                                                })
                                                            })
                                                            $(document).ready(function() {
                                                                $(<?php echo '.commentbtn' . $cont ?>).on('click', function() {
                                                                    $(<?php echo '#commentmodal' . $cont ?>).modal('show');
                                                                })
                                                            })
                                                        </script>
                                                    </li>
                                                    <li><a href="../controllers/myAcount_controller.php?delete=<?php echo $postId ?>"><button class="btn">delete</button></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                            <?php }
                            } ?>
                            <form action="../controllers/myAcount_controller.php" method="POST">
                                <div class="modal-body d-flex">
                                    <input type="message" placeholder="write a comment..." class="form-control me-3" name="comment" />

                                    <input type="hidden" name="postId" value="<?php echo $postId ?>">
                                    <input type="hidden" name="auhorId" value="<?php echo $authorId ?>">
                                    <input type="submit" class="btn " name="addcomment" value="Add">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>