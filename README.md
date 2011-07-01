Paml: PHP array markup language
===============================

Paml is a DSL to write HTML with PHP's plain array.

Syntax
------

If you input below code,

    ["div",
      ["ul",
        ["li", "Foo"]
        ["li", "Bar"]
        ["li", "Baz"]]]

Here's the HTML you'll get.

    <div>
      <ul>
        <li>Foo</li>
        <li>Bar</li>
        <li>Baz</li>
      </ul>
    </div>

Author
------

Yuya Takeyama
