from html.parser import HTMLParser
from urllib import parse


class LinkFinder(HTMLParser):

    def __init__(self, base_url, page_url):
        super().__init__()
        self.base_url = base_url
        self.page_url = page_url
        self.links = set()
        self.isTitle = False
        self.title = ''

    # When we call HTMLParser feed() this function is called when it encounters an opening tag <a>
    def handle_starttag(self, tag, attrs):
        if tag == 'a':
            for (attribute, value) in attrs:
                if attribute == 'href':
                    url = parse.urljoin(self.base_url, value)
                    print(url)
                    self.links.add(url)
        elif tag == 'img':
            for (attribute, value) in attrs:
                if attribute == 'src':
                    url = parse.urljoin(self.base_url, value)
                    self.links.add(url)
        if tag == 'title':
            self.isTitle = True
        else:
            self.isTitle = False

    def handle_data(self, data):
        if self.isTitle:
            self.title = data
            self.isTitle = False

    def page_links(self):
        return self.links

    def get_title(self):
        return self.title

    # def page_imgs(self):
    #     return self.imgs

    def error(self, message):
        pass
