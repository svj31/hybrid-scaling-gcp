# VCC Assignment 3: Create a Local VM and Auto-Scale to Google Cloud Platform when Resource Usage Exceeds 75% in Local VM


## Overview

This project demonstrates a **Hybrid Cloud Scaling system** where a Local Virtual Machine monitors its CPU usage and triggers horizontal scaling in the cloud using a **Managed Instance Group (MIG)** on Google Cloud Platform (GCP). The system simulates a real-world **cloud bursting scenario**, where local infrastructure dynamically extends to cloud resources under high load conditions.


## Objective

- Monitor CPU usage on a Local VM
- Trigger cloud scaling when CPU usage exceeds 75%
- Use Managed Instance Group for horizontal scaling
- Deploy application automatically on all cloud instances
- Demonstrate hybrid cloud behavior


## Architecture Diagram

![Architecture Diagram](architecture-diagram.png)


## System Components

### 1. Local VM (VirtualBox)
- Ubuntu-based virtual machine
- Hosts monitoring script
- Runs sample web application

### 2. Monitoring Script
- Implemented in Python using `psutil`
- Continuously monitors CPU usage
- Triggers scaling of Managed Instance Group using `gcloud CLI`

### 3. Google Cloud Platform (GCP)

#### Managed Instance Group (MIG)
- Maintains multiple VM instances
- Automatically provisions new instances when triggered
- Ensures consistent configuration using instance template

#### Instance Template
- Defines VM configuration
- Includes startup script to:
  - Install Apache and PHP
  - Clone GitHub repository
  - Deploy application automatically

### 4. Sample Application
- PHP-based web application
- Displays:
  - Hostname
  - Internal IP
  - Execution environment
  - Scaling status


## Workflow

1. Application runs on Local VM
2. Monitoring script checks CPU usage every 5 seconds
3. If CPU > 75%:
   - Script triggers scaling of Managed Instance Group
4. MIG increases number of instances
5. New VMs are created automatically
6. Startup script deploys application on each instance
7. Application becomes available on all cloud VMs


## Technologies Used

- VirtualBox (Local Virtualization)
- Google Cloud Platform (Compute Engine)
- Managed Instance Group (MIG)
- Python (Monitoring Script)
- psutil (CPU Monitoring)
- Apache + PHP (Web Application)
- GitHub (Version Control)


## Key Features

- Threshold-based scaling (CPU > 75%)
- Hybrid cloud architecture (Local → Cloud)
- Horizontal scaling using Managed Instance Group
- Automated deployment using startup script
- Real-time monitoring and triggering


## How to Run

Refer to: deployment/steps.md


## Results

- Successfully triggered MIG scaling based on local CPU usage
- Verified creation of multiple VM instances
- Application deployed automatically on new instances
- Demonstrated hybrid + horizontal scaling mechanism


## Conclusion

This project demonstrates how local infrastructure can dynamically scale into cloud resources using a hybrid approach. By integrating monitoring with Managed Instance Groups, the system achieves both **elasticity and scalability**, similar to real-world cloud architectures.


### Name: Shrusti Jain  
### Roll No: M25CSE030  