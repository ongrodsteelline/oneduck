<?php
/**
 * Template Name: Profile Old
 */

global $user_ID;

if (!$user_ID) {
    header('location:'.site_url().'/');
    exit;
} else {
    $userdata = get_user_by('id', $user_ID);
}
$user = wp_get_current_user();

get_header();
?>
    <main class="main">
        <section class="profile">
            <h1><?php the_title(); ?></h1>
            <profile v-bind:user='@json($user)'></profile>
        </section><!-- /profile -->
    </main>
<?php get_footer(); ?>