<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Hello there</title>
        <style>
            .center {
                display: block;
                margin-left: auto;
                margin-right: auto;
                width: 50%;
            }
        </style>
    </head>
    <body>
        <h1>Welcome</h1>
        <p>Docker recommends running only one process per container, which roughly means that each container should be running a single piece of software. 
        the LEMP stack are:
            <ul>
                <li>L is for Linux;</li>
                <li>E is for Nginx</li>
                <li>M is for MySQL;</li>
                <li>P is for PHP.</li>
            </ul>
        </p>
        <p>
        Linux is the operating system Docker runs on, so that leaves us with Nginx, MySQL and PHP. For convenience, we will also add phpMyAdmin into the mix. As a result, we now need the following containers:
            <ul>
                <li>one container for Nginx. Size: 126MB</li>
                <li>one container for PHP (PHP-FPM) Size: 405MB</li>
                <li>one container for MySQL. Size: 545MB</li>
                <li>one container for phpMyAdmin. Size: 469MB</li>
                <li>Totalling up to rough 1.5 GB = not light.  Unnecessarily increasing the size of the images can impact performance, security, and sometimes the cost of deployment. </li>
                <li> Use Alpine Linux: Reduced by half. total roughly 700MB. The smaller the image, the smaller the potential attack surface.</li>
            </ul>
        </p>
        <p>Start and run the containers in the background:<br/><code>$ docker-compose up -d</code></p>
        <p>This command aggregates the logs of every container, which is extremely useful for debugging: if anything goes wrong, your first reflex should always be to look at the logs. It is also possible to display the information of a specific container simply by appending the name of the service (e.g. docker-compose logs -f nginx)s</p>
        <code>$docker-compose logs -f</code>
        <p>Since we haven't updated docker-compose.yml nor any Dockerfile, this time a simple <code>docker-compose up -d</code> won't be enough for Docker Compose to pick up the changes. We need to explicitly tell it to restart the containers so the Nginx process is restarted and the new configuration is taken into account: <br>
            <code>$docker-compose restart</code>
        </p>
        <p>
        List the containers<br/><code>$ docker-compose ps</code>
        </p>
        <p>Stop the containers<br/><code>$docker-compose stop</code>
        </p>
        <p>Stop and/or destroy the containers: <br><code>$docker-compose down</code></p>
        <p>
        Destroys containers and volumes, so we can start afresh: <code>$docker-compose down -v</code>
        </p>
        <p>Delete everything, including images:<br/><code>$docker-compose down -v --rmi all</code></p>
        <p>
        Save the file and run docker-compose up -d again, followed by docker-compose ps: each container is now prefixed with demo_. </br>
        Why is this important? By assigning a unique name to your project, you ensure that no name collision will happen with other ones. If there are multiple Docker-based projects on your system that share the same name or directory name, and more than one use a service called nginx, Docker may complain that another container named xxx_nginx already exists when you bring up a Docker environment. <br/>
        While this might not seem essential, it is an easy way to avoid potential hassle in the future, and provides some consistency across the team. Speaking of which: if you've dealt with .env files before, you probably know that they are not supposed to be versioned and pushed to a code repository. Assuming you are using Git, you should add .env to a .gitignore file, and create a .env.example file that will be shared with your coworkers.
        </p>
        <img src="https://tech.osteel.me/images/2020/03/04/hello.gif" alt="Hello there" class="center">
        <?php
        $connection = new PDO('mysql:host=mysql;dbname=demo;charset=utf8', 'root', 'root');
        $query      = $connection->query("SELECT TABLE_NAME FROM information_schema.TABLES WHERE TABLE_SCHEMA = 'demo'");
        $tables     = $query->fetchAll(PDO::FETCH_COLUMN);

        if (empty($tables)) {
            echo '<p class="center">There are no tables in database <code>demo</code>.</p>';
        } else {
            echo '<p class="center">Database <code>demo</code> contains the following tables:</p>';
            echo '<ul class="center">';
            foreach ($tables as $table) {
                echo "<li>{$table}</li>";
            }
            echo '</ul>';
        }
        ?>
    </body>
</html>