<aside class="sidebar">

    <div class="sidebar-logo">
        <h2>Kelly</h2>
        <span>Admin Panel</span>
    </div>

    <nav class="sidebar-nav">

        <a href="index.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>

        <a href="profile.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'profile.php' ? 'active' : '' ?>">
            <i class="bi bi-person"></i>
            <span>Profile</span>
        </a>

        <a href="education.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'education.php' ? 'active' : '' ?>">
            <i class="bi bi-mortarboard"></i>
            <span>Education</span>
        </a>

        <a href="experience.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'experience.php' ? 'active' : '' ?>">
            <i class="bi bi-briefcase"></i>
            <span>Experience</span>
        </a>

        <a href="skills.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'skills.php' ? 'active' : '' ?>">
            <i class="bi bi-bar-chart"></i>
            <span>Skills</span>
        </a>

        <a href="services.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'services.php' ? 'active' : '' ?>">
            <i class="bi bi-gear"></i>
            <span>Services</span>
        </a>

        <a href="portfolio.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'portfolio.php' ? 'active' : '' ?>">
            <i class="bi bi-images"></i>
            <span>Portfolio</span>
        </a>

        <a href="messages.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'messages.php' ? 'active' : '' ?>">
            <i class="bi bi-envelope"></i>
            <span>Messages</span>
        </a>

        <a href="contact.php"
           class="<?= basename($_SERVER['PHP_SELF']) === 'contact.php' ? 'active' : '' ?>">
            <i class="bi bi-telephone"></i>
            <span>Contact Info</span>
        </a>

        <a href="logout.php" class="logout-link">
            <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
        </a>

    </nav>

</aside>