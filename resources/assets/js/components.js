const COMPONENTS = [
    "example_component",
    "loading_logo"
];

// Load the components
COMPONENTS.forEach((component) => {
    require(`./components/${component}`);
});
