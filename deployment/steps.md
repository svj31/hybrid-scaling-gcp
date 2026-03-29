# Deployment Steps – Hybrid Scaling (Local VM to GCP)


## 1. Local VM Setup (VirtualBox)

- Create Ubuntu VM using VirtualBox
- Update system:
sudo apt update && sudo apt upgrade -y
- Install required tools:
sudo apt install python3 python3-pip apache2 php git stress -y
- Install Python library:
pip3 install psutil


## 2. Clone Repository (Local VM)

- Navigate to web directory:
cd /var/www/html
sudo rm -rf *
- Clone repository:
sudo git clone https://github.com/svj31/hybrid-scaling-gcp.git .
- Restart Apache:
sudo systemctl restart apache2
- Access application using http://localhost


## 3. GCP VM Setup

- Create VM instance (Ubuntu 22.04)
- Install required packages:
sudo apt update
sudo apt install apache2 php git -y
- Clone repository:
cd /var/www/html
sudo rm -rf *
sudo git clone https://github.com/svj31/hybrid-scaling-gcp.git .
- Restart Apache:
sudo systemctl restart apache2


## 4. Setup GCP CLI (Local VM)

- Install gcloud CLI:
curl https://sdk.cloud.google.com | bash
exec -l $SHELL
- Initialize:
gcloud init


## 5. Monitoring Script Execution

- Navigate to monitoring folder:
cd ~/hybrid-scaling-gcp/monitoring
- Run script:
python3 monitor.py


## 6. Trigger CPU Load

- In another terminal run stress command:
stress --cpu 2 --timeout 60


## 7. Expected Behavior

- CPU usage exceeds 75%
- Monitoring script detects threshold breach
- GCP VM starts automatically
- Application becomes accessible on GCP VM


## 8. Verification

- Check VM status in GCP console
- Access application via external IP
- Confirm hostname difference (Local vs Cloud)