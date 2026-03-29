import psutil
import time
import os

THRESHOLD = 75
CHECK_INTERVAL = 5

MIG_NAME = "vcc-managed-group"
ZONE = "asia-south1-a"

triggered = False

def get_instance_count():
    output = os.popen(
        f"gcloud compute instance-groups managed list-instances {MIG_NAME} --zone={ZONE} --format='value(instance)'"
    ).read()
    return len(output.strip().split("\n")) if output.strip() else 0

while True:
    cpu = psutil.cpu_percent(interval=1)
    print(f"CPU Usage: {cpu}%")

    if cpu > THRESHOLD and not triggered:
        count = get_instance_count()
        print(f"Current MIG instances: {count}")

        if count < 2:
            print("Threshold exceeded! Scaling MIG to 2 instances...")
            os.system(
                f"gcloud compute instance-groups managed resize {MIG_NAME} --size=2 --zone={ZONE}"
            )
            triggered = True
        else:
            print("Already scaled.")

    time.sleep(CHECK_INTERVAL)