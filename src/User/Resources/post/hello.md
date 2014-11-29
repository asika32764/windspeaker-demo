Welcome to [WindSpeaker](http://windspeaker.co), this is an example article of [Markdown](http://daringfireball.net/projects/markdown/) which is the main syntax that WindSpeaker used.


<!-- {READMORE} -->


# Basic writing

## Paragraphs

Paragraphs in Markdown are just one or more lines of consecutive text followed by one or more blank lines.

On July 2, an alien mothership entered Earth's orbit and deployed several dozen saucer-shaped "destroyer" spacecraft, each 15 miles (24 km) wide.

On July 3, the Black Knights, a squadron of Marine Corps F/A-18 Hornets, participated in an assault on a destroyer near the city of Los Angeles.
Headings

### Code block

    Code blocks are very useful for developers and other people who look at code or other things that are written in plain text. 
    As you can see, it uses a fixed-width font.

GitHub Flavored Code block

    ``` php
    <?php namespace Illuminate\Filesystem;
    
    use FilesystemIterator;
    use Symfony\Component\Finder\Finder;
    
    class Filesystem {
    
    	/**
    	 * Get the returned value of a file.
    	 *
    	 * @param  string  $path
    	 * @return mixed
    	 *
    	 * @throws FileNotFoundException
    	 */
    	public function getRequire($path)
    	{
    		if ($this->isFile($path)) return require $path;
    
    		throw new FileNotFoundException("File does not exist at path {$path}");
    	}
    }
    ```

``` php
<?php namespace Illuminate\Filesystem;

use FilesystemIterator;
use Symfony\Component\Finder\Finder;

class Filesystem {

	/**
	 * Get the returned value of a file.
	 *
	 * @param  string  $path
	 * @return mixed
	 *
	 * @throws FileNotFoundException
	 */
	public function getRequire($path)
	{
		if ($this->isFile($path)) return require $path;

		throw new FileNotFoundException("File does not exist at path {$path}");
	}
}
```

You can also make `inline code` to add code into other things.

## Headings

You can create a heading by adding one or more # symbols before your heading text. The number of # you use will determine the size of the heading.

``` markdown
# Headin 1
## Heading2
### Heading3
#### Heading4
##### Heading5
###### Heading6

### Headings *can* also contain **formatting**

### They can even contain `inline code`
```

# Headin 1
## Heading2
### Heading3
#### Heading4
##### Heading5
###### Heading6

### Headings *can* also contain **formatting**

### They can even contain `inline code`


## Styling text


You can make text bold or italic.

``` markdown
*This text will be italic*
**This text will be bold**
```

*This text will be italic*
**This text will be bold**

Both bold and italic can use either a * or an _ around the text for styling. This allows you to combine both bold and italic if needed.

``` markdown
**Everyone _must_ attend the meeting at 5 o'clock today.**
```

**Everyone _must_ attend the meeting at 5 o'clock today.**


## Lists

### Unordered lists

You can make an unordered list by preceding list items with either a * or a -.

``` markdown
* Item
* Item
* Item

- Item
- Item
- Item
```

* Item
* Item
* Item

- Item
- Item
- Item

### Ordered lists

You can make an ordered list by preceding list items with a number.

``` markdown
1. Item 1
2. Item 2
3. Item 3
```

1. Item 1
2. Item 2
3. Item 3


### Nested lists

You can create nested lists by indenting list items by two spaces.

``` markdown
1. Item 1
  1. A corollary to the above item.
  2. Yet another point to consider.
2. Item 2
  * A corollary that does not need to be ordered.
    * This is indented four spaces, because it's two spaces further than the item above.
    * You might want to consider making a new list.
3. Item 3
```

1. Item 1
  1. A corollary to the above item.
  2. Yet another point to consider.
2. Item 2
  * A corollary that does not need to be ordered.
    * This is indented four spaces, because it's two spaces further than the item above.
    * You might want to consider making a new list.
3. Item 3

## Links

You can create an inline link by wrapping link text in brackets ( `[ ]` ), and then wrapping the link in parenthesis ( `( )` ).

For example, to create a hyperlink to www.github.com, with a link text that says, Visit GitHub!, you'd write this in Markdown: `[Visit GitHub!](www.github.com)`.

[Visit GitHub!](www.github.com)

# Table

``` markdown
| Tables        | Are           | Cool  |
| ------------- |:-------------:| -----:|
| col 1         | Hello         | $1600 |
| col 2         | Hello         |   $12 |
| col 3         | Hello         |    $1 |
```

| Tables        | Are           | Flower |
| ------------- |:-------------:| ------:|
| Row 1         | Hello         | Sakura |
| Row 2         | Hello         |  Olive |
| Row 3         | Hello         |   Rose |
