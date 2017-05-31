import threading
from json_exporter import *
# import argparse
from queue import Queue
from spider import Spider
from domain import *
from general import *


# **************** for unix lovers
# parser = argparse.ArgumentParser()
# # arguments
# parser.add_argument("project", help="input project name")
# parser.add_argument("home", type=int, help="input homepage (must be url).")
# parser.add_argument("threads", type=int, help="number of spider threads to work.")
#
# # parse arguments
# args = parser.parse_args()

# *****************************OLD FROM REPO

# PROJECT_NAME = 'viper-seo'
# HOMEPAGE = 'https://kalalex.github.io/mem-web/'
# DOMAIN_NAME = get_domain_name(HOMEPAGE)
# QUEUE_FILE = PROJECT_NAME + '/queue.txt'
# CRAWLED_FILE = PROJECT_NAME + '/crawled.txt'
# NUMBER_OF_THREADS = 22
queue = Queue()
# Spider(PROJECT_NAME, HOMEPAGE, DOMAIN_NAME)
# ****************************************

# Create worker threads (will die when main exits)


def create_workers():
    for _ in range(NUMBER_OF_THREADS):
        t = threading.Thread(target=work)
        t.daemon = True
        t.start()


# Do the next job in the queue
def work():
    while True:
        url = queue.get()
        Spider.crawl_page(threading.current_thread().name, url)
        queue.task_done()


# Each queued link is a new job
def create_jobs():
    for link in file_to_set(QUEUE_FILE):
        queue.put(link)
    queue.join()
    crawl()


# Check if there are items in the queue, if so crawl them
def crawl():
    queued_links = file_to_set(QUEUE_FILE)
    if len(queued_links) > 0:
        print(str(len(queued_links)) + ' links in the queue')
        create_jobs()


# Input
# AS ARGUMENTS IMPLEMENTATION
# PROJECT_NAME = args.project
# HOMEPAGE = args.home
# NUMBER_OF_THREADS = args.threads

# SIMPLE INPUT
# PROJECT_NAME = input("Enter Project Name: ")
# HOMEPAGE = input("Enter Page To Crawl: ")
# NUMBER_OF_THREADS = int(input("Enter Threads: "))
NUMBER_OF_THREADS = 3
HOMEPAGE = []
with open("input.txt", "r") as fin:
    for line in fin:
        HOMEPAGE.append(line.strip("\n"))

for i in range(0, len(HOMEPAGE)):
    with open("output.txt", 'w'):
        pass
    # Set paths
    DOMAIN_NAME = get_domain_name(HOMEPAGE[i])
    QUEUE_FILE = str(i) + '/queue.txt'
    CRAWLED_FILE = str(i) + '/crawled.txt'
    # Set spider target
    Spider(str(i), HOMEPAGE[i], DOMAIN_NAME)
    # Run crawler
    create_workers()
    crawl()
    # Export json
    export_to_json(str(i), HOMEPAGE[i], DOMAIN_NAME)
