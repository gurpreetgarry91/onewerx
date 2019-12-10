=== PWP Lytebox ===
Contributors: polkan
Tags: lightbox, lytebox, light box, popup images, modal window images
Requires at least: 3.5.0
Tested up to: 4.3.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The fast and simple way to make all links pointing to images open in popup modal window.

== Description ==

Plugin uses light-weight Lytebox js-project by Markus F. Hay (http://lytebox.com, Creative Commons Attribution 3.0 License).

After activate, plugin will make modal-window-openable every link with href="...image" found in post (or page, or custom post) content.

To prevent link to be treated by plugin put "?" symbol on its end:
`<a href="image.jpg">...</a> - opens in modal window
<a href="image.jpg?">...</a> - standard behaviour`
You can show name and description of picture in modal window. Just put them into "title" and "data-description" attributes:
`<a href="image.jpg" title="Picture name">...</a>
<a href="image.jpg" title="Picture name" data-description="This picture is...">...</a>`

Settings: 

* select color scheme
* disable autogroup images *(Thus you can manually group images from one page to a several groups)*

+++++++++++++++++++++

Находит в контенте все ссылки, которые ведут на изображения и делает их открывающимися в модальном окне

Чтобы сделать исключение, добавьте знак ? в конец адреса картинки<br>
`<a href="image.jpg">...</a> - откроется в модальном окне
<a href="image.jpg?">...</a> - откроется стандартно`
Подпись и описание для изображения берутся из атрибутов title и data-description<br>
`<a href="image.jpg" title="Картинка 1">...</a>
<a href="image.jpg" title="Картинка 1" data-description="На этой картинке изображено...">...</a>`

В настройках можно выбрать цветовую схему, а также отключить автогруппировку изображений (создавать группы для перехода по картинкам можно будет вручную).

== Installation ==

1. Install plugin either via your wp-admin plugins page, or by uploading the files to your server.
2. Activate the plugin.

== Screenshots ==

1. Modal window with image

== Changelog ==

= 1.3.2 =
* Fix regular expression

= 1.3.1 =
* Update translation

= 1.3.0 =
* Add resise speed setting

= 1.2.3 =
* Fix regular expression

= 1.2.1 =
* Fix activation function

= 1.2.0 =
* Add setting to select color scheme

= 1.1.0 =
* Add settings page. Add setting to disable autogroup images.
* Add localisation support. Translate to Russian.

= 1.0.5 =
* PWP Lytebox 
