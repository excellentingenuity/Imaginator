The Imagator should use the supplied persistance layer to store images and thumbnails.
Each image is contained in a global list but for specific uses such as logo or product image a child mutator class with
a secondary persisted list of which image belongs to what specific use.

Imagator should be extracted to a standalone package

desired use `$image(s) = Imaginator::load($this, 'id');` -> where $this is supplied to get the class name and the property
that corresponds to the specific instance in the db is supplied.