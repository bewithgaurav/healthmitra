#!D:\rajasthan\myvenv\Scripts\python.exe
# EASY-INSTALL-ENTRY-SCRIPT: 'ndg-httpsclient==0.4.2','console_scripts','ndg_httpclient'
__requires__ = 'ndg-httpsclient==0.4.2'
import sys
from pkg_resources import load_entry_point

if __name__ == '__main__':
    sys.exit(
        load_entry_point('ndg-httpsclient==0.4.2', 'console_scripts', 'ndg_httpclient')()
    )
