# codeigniter-output-hook

## What Is This?
A hook for CodeIgniter to hijack the output and replace %%string%% with $this->config->item('string')

## Why?
I build/maintain a lot of websites for pharmaceutical companies with CodeIgniter. I utilize the custom config object to store variables of brand names and other things that are displayed in abundance throughout the sites. In the past I would break the copy as needed to inject a config variable like so:

`All your problems are solved if you use <?php echo $this->config->item('brand_name'); ?>. Blah blah blah <?php echo $this->config->item('brand_name'); ?> is a great thing to use if you have <?php echo $this->config->item('disease_state'); ?>.`

As you can see, over time that can become a real pain, to keep breaking the flow of entering copy to call the config variable needed.

With this hook, you will no longer need to worry about that. You can now call the same custom config variables by wrapping them in 'double percents'. So the above example now turns into this:

`All your problems are solved if you use %%brand_name%%. Blah blah blah %%brand_name%% is a great thing to use if you have %%disease_state%%.`

WHEW! Much better. The great thing about this hook, is it doesn't break the existing use of the standard CodeIgniter `$this->config->item()` call, so you can pull this into existing projects, and change the way you call config vars as you make updates, rather than having to globally retrofit this in.

### Step 1

In `application/config/config.php` set `$config['enable_hooks']` to `TRUE`

### Step 2

In `application/config/hooks.php` add the following:

    $hook['display_override'] = array(
     'class'    => 'Display_Override',
     'function' => 'displayOverrideRender',
     'filename' => 'Display_Override.php',
     'filepath' => 'hooks',
     'params'   => array()
    );

### Step 3

Add **Display_Override.php** to `application/hooks/`
