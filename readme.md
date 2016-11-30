# Maria

It grabs images from folder and converts them to desired dimensions.

*Has support for custom prefixes.*

## Installation

```bash
composer global require mabasic/maria
```

## Usage

Standard usage scenario:

```bash
maria fit {input} {output} --width=1920 --height=1080
```

Append prefix `thumb_` to images on output:

```bash
maria fit {input} {output} --width=1920 --height=1080 --prefix
```

Or set a custom prefix with:

```bash
maria fit {input} {output} --width=1920 --height=1080 --prefix=big_
```
