<div class="cntainer fixed-top">
    <div class="logo">
        <img src="../images/logo3-.png" alt="" />
    </div>
    <div class="navbar">
        <li>
            <ul>
                <a href="../views/myAcount.php" class="fw-bold">Home</a>
            </ul>
            <ul>
                <a href="#footer" class="fw-bold">Contact us</a>
            </ul>
        </li>
    </div>
    <div class="login">
        <span class="pe-3">
            <?php
            $setUser = new MyAccount();  ?>
            <a href="profil.php"><img class="" src="../images/avatar.webp" alt="images" /><?php echo  $setUser->firstName . ' ' . $setUser->lastName; ?></a>
        </span>
        <span class="pe-3">
            <!-- <form action="../controllers/login_controller.php" method="POST"> -->
            <a href="../controllers/login_controller.php?logout=logout"><i class="fa-solid fa-right-from-bracket pe-2"></i></a> 
                    <!-- <input name="logout" type="submit" value="Log out" style="background: transparent; color: white; border: none" /> -->
            <!-- </form> -->
        </span>
    </div>
</div>