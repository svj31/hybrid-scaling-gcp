import psutil
import time
import os

THRESHOLD = 75
CHECK_INTERVAL = 5

VM_NAME = "vcc-base-vm"
ZONE = "asia-south1-a"

triggered = False

def get_vm_status():
    status = os.popen(f"gcloud compute instances describe {VM_NAME} --zone={ZONE} --format='get(status)'").read().strip()
    return status

while True:
    cpu = psutil.cpu_percent(interval=1)
    print(f"CPU Usage: {cpu}%")

    if cpu > THRESHOLD and not triggered:
        vm_status = get_vm_status()
        print(f"VM Status: {vm_status}")

        if vm_status == "TERMINATED":
            print("Threshold exceeded! Starting GCP VM...")
            os.system(f"gcloud compute instances start {VM_NAME} --zone={ZONE}")
            triggered = True
        else:
            print("VM already running or starting. Skipping trigger.")

    time.sleep(CHECK_INTERVAL)