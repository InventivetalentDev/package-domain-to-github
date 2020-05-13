# Package-Domain to GitHub

Simple script to redirect subdomains to corresponding GitHub repositories


## Setup
* Create a wildcard subdomain DNS record (e.g. *.inventivetalent.org) - You can also point specific subdomains to the script, but who's got time for that?
* Create a GitHub personal access token
* Rename rename `vars.example.php` to `vars.php` 
  * Change AUTH to the base64 encoded value of `<github username>:<personal access token>`
  * Change USER to your GitHub username
* Done! (wait for the DNS records to update first) Go to package.yourdomain.com and try it :) 
