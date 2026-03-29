import psutil
import time
import os

THRESHOLD = 75  # CPU %
CHECK_INTERVAL = 5  # seconds

VM_NAME = "vcc-base-vm"
ZONE = "asia-south1-a"

triggered = False

while True:
    cpu = psutil.cpu_percent(interval=1)
    print(f"CPU Usage: {cpu}%")

    if cpu > THRESHOLD and not triggered:
        print("⚡ Threshold exceeded! Triggering GCP VM...")

        os.system(f"gcloud compute instances start {VM_NAME} --zone={ZONE}")

        triggered = True

    time.sleep(CHECK_INTERVAL)