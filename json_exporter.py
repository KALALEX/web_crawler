import json


def export_to_json(PROJECT_NAME, HOMEPAGE, DOMAIN_NAME):
    # Get all crawled in a set
    all_links = []
    with open("output.txt") as fin:
        for line in fin:
            line = line.strip("\n")
            line = line.split(",")
            all_links.append(line)

    # convert crawled into
    # b= all_links[1][0]
    # a= all_links[0][1]
    # i=0
    with open(PROJECT_NAME + ".json", "w") as fout:
        json.dump({'homepage': HOMEPAGE, 'domain_name': DOMAIN_NAME, 'pages': all_links}, fout, indent=1,
                  sort_keys=True)
        # for i in range(0, len(all_links)):
        #     json.dump({'link':all_links[i][0] , 'title': all_links[i][1]}, fout, indent=1, sort_keys=True)


        # {'homepage': HOMEPAGE, 'domain_name': DOMAIN_NAME, 'pages':{'link': all_links, 'title': all_links[1]}}