# simplenews
Converts a BBC News Page to an array.
``` 
include "simplenews.php"
$output=getNews("https://www.bbc.co.uk/news/uk-50879809",4)
print_r($output);
```
The first input is the URL to be downloaded. The second is the max number of paragraphs you want.
The function will return an array of the following format:
```
array(shorttitle,longtitle,description,url,area,inro,paragraphs);
```
The paragraphs are delivered as another array.
