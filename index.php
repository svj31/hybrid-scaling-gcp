<!DOCTYPE html>
<html>
<head>
    <title>VCC Assignment 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            width: 520px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }
        h1 {
            text-align: center;
            color: #1e3c72;
        }
        h2 {
            color: #2a5298;
            margin-top: 20px;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        li {
            margin: 6px 0;
        }
        .footer {
            text-align: center;
            margin-top: 15px;
            font-size: 13px;
            color: gray;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>VCC Assignment 3</h1>
        <p style="text-align:center;"><b>Hybrid Scaling: Local VM to Cloud (GCP)</b></p>

        <h2>Student Details</h2>
        <ul>
            <li><b>Name:</b> Shrusti Jain</li>
            <li><b>Roll No:</b> M25CSE030</li>
        </ul>

        <h2>Execution Environment</h2>
        <ul>
            <li><b>Environment:</b> 
                <?php 
                if (strpos(gethostname(), 'base') !== false) {
                    echo "Local VM (VirtualBox)";
                } else {
                    echo "Cloud VM (GCP)";
                }
                ?>
            </li>
        </ul>

        <h2>Instance Details</h2>
        <ul>
            <li><b>Hostname:</b> <?php echo gethostname(); ?></li>
            <li><b>Internal IP:</b> <?php echo gethostbyname(gethostname()); ?></li>
            <li><b>Current Time:</b> <?php echo date('Y-m-d H:i:s'); ?></li>
        </ul>

        <h2>Scaling Mechanism</h2>
        <ul>
            <li>Local VM CPU Monitoring</li>
            <li>Threshold Trigger (>75%)</li>
            <li>Automatic Cloud VM Activation</li>
            <li>Hybrid Cloud Scaling Demonstration</li>
            <li><b>Triggered By:</b> Local VM CPU Utilization</li>
        </ul>

        <h2>Scaling Status</h2>
        <ul>
            <li><b>Status:</b> 
                <?php
                    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                        echo "Monitoring Available in VM (Linux Only)";
                    } else {
                        $load = sys_getloadavg();
                        echo ($load[0] > 0.75) ? "Scaling Triggered" : "Running Normally";
                    }
                ?>
            </li>
        </ul>

        <div class="footer">
            Hybrid Cloud Scaling Demonstration (Local to GCP)
        </div>
    </div>
</body>
</html>