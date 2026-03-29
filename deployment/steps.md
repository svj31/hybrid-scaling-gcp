# Deployment Steps – Hybrid Scaling (Local VM → GCP Managed Instance Group)


## 1. Local VM Setup (VirtualBox)

- Create Ubuntu VM using VirtualBox
- Update system:
```
sudo apt update && sudo apt upgrade -y
```
- Install required tools:
```
sudo apt install python3 python3-pip apache2 php git stress -y
```
- Install Python library:
```
pip3 install psutil
```


## 2. Clone Repository (Local VM)

- Navigate to web directory:
```
cd /var/www/html
sudo rm -rf *
```
- Clone repository:
```
sudo git clone [https://github.com/svj31/hybrid-scaling-gcp.git] .
```
- Restart Apache:
```
sudo systemctl restart apache2
```
- Access application:
```
[http://localhost]
```


## 3. GCP Setup (Managed Instance Group)

### Step 1: Create Instance Template
- Create an instance template with:
  - Ubuntu 22.04
  - HTTP traffic allowed
  - Startup script to install Apache, PHP, and deploy app from GitHub

### Step 2: Configure Startup Script
Startup script used in instance template can be accesed from: deployment/startup-script.sh

### Step 3: Create Managed Instance Group (MIG)

- Create a Managed Instance Group using the instance template
- Initial size: 1 instance
- Zone: asia-south1-a

## 4. Setup GCP CLI (Local VM)

- Install gcloud CLI:
```
curl [https://sdk.cloud.google.com] | bash
exec -l $SHELL
```
- Initialize:
```
gcloud init
```


## 5. Monitoring Script Execution

- Navigate to monitoring folder:
```
cd ~/hybrid-scaling-gcp/monitoring
```
- Run script:
```
python3 monitor.py
```


## 6. Trigger CPU Load

- In another terminal:
```
stress --cpu 2 --timeout 60
```


## 7. Scaling Mechanism (MIG)

- When CPU usage exceeds 75%:
  - Monitoring script triggers scaling
  - Managed Instance Group is resized (e.g., 1 to 2 instances)
  - New VM instances are created automatically
  - Startup script deploys application on new instances


## 8. Verification

- Check number of instances:
```
gcloud compute instance-groups managed list-instances vcc-managed-group --zone=asia-south1-a
```
- Observe:
  - Instance count increases
  - New VM gets created
  - Application runs on new instance
- Access application via external IP of any instance


## 9. Notes

- This implementation demonstrates **threshold-based hybrid scaling**
- Scaling is triggered from Local VM and executed in Cloud (GCP)
- Managed Instance Group enables **horizontal scaling**