<?php
// PHP Proxy for Blogger RSS Feed
// This section will only execute if the URL contains "?get_feed=true"
if (isset($_GET['get_feed']) && $_GET['get_feed'] === 'true') {
    $rss_feed_url = 'https://skvgamerzyt.blogspot.com/feeds/posts/default?alt=rss';

    // Attempt to fetch the RSS feed
    // Use file_get_contents for simplicity. For more robust needs, cURL would be better.
    $feed_content = @file_get_contents($rss_feed_url); // @ suppresses warnings

    if ($feed_content === FALSE) {
        // Handle error if feed could not be fetched
        http_response_code(500); // Internal Server Error
        header('Content-Type: text/plain');
        echo "Error: Could not fetch RSS feed from Blogger.";
        exit;
    }

    // Set content type header to XML so the browser/JS can parse it
    header('Content-Type: application/xml');
    echo $feed_content;
    exit; // Stop execution after sending the feed content
}
// End of PHP Proxy block
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="SKVGamerz - Your ultimate source for gaming content. Find new games, Android games, PC games, and the best emulators. Level up your gaming experience!">
    <title>SKVGamerz - Level Up Your Gaming Experience</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>
/* Modern Light Theme with Pastel Colors */
:root {
    --primary-color: #6366f1; /* Soft indigo */
    --secondary-color: #f472b6; /* Soft pink */
    --accent-color: #34d399; /* Soft emerald */
    --background-light: #fafaff; /* Very light blue-white */
    --background-white: #ffffff;
    --card-background: #f8fafc; /* Light slate */
    --text-primary: #1e293b; /* Dark slate */
    --text-secondary: #64748b; /* Slate gray */
    --text-muted: #94a3b8; /* Light slate gray */
    --border-light: #e2e8f0; /* Very light slate */
    --border-color: #cbd5e1; /* Light slate */
    --shadow-light: rgba(0, 0, 0, 0.04);
    --shadow-medium: rgba(0, 0, 0, 0.08);
    --shadow-heavy: rgba(0, 0, 0, 0.12);
    --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    background-color: var(--background-light);
    overflow-x: hidden;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
    font-family: 'Poppins', sans-serif;
    margin-bottom: 1rem;
    color: var(--text-primary);
    font-weight: 600;
    line-height: 1.2;
}

h1 { font-size: 3.5rem; }
h2 { font-size: 2.5rem; }
h3 { font-size: 2rem; }
h4 { font-size: 1.5rem; }
h5 { font-size: 1.25rem; }
h6 { font-size: 1rem; }

p {
    margin-bottom: 1rem;
    color: var(--text-secondary);
    font-size: 1.1rem;
}

/* Smooth Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fadeInLeft {
    from {
        opacity: 0;
        transform: translateX(-30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes fadeInRight {
    from {
        opacity: 0;
        transform: translateX(30px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

/* Reveal animations */
.reveal {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.reveal.active {
    opacity: 1;
    transform: translateY(0);
}

/* Page Loader */
.page-loader {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--background-white);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
    opacity: 1;
    transition: opacity 0.5s ease-out;
}

.page-loader.hidden {
    opacity: 0;
    pointer-events: none;
}

.loader-content {
    text-align: center;
}

.loader-spinner {
    width: 50px;
    height: 50px;
    border: 3px solid var(--border-light);
    border-top: 3px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    margin: 0 auto 20px;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loader-text {
    color: var(--primary-color);
    font-family: 'Poppins', sans-serif;
    font-size: 1.1rem;
    font-weight: 500;
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px 24px;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: none;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    text-transform: none;
    letter-spacing: 0;
}

.btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.btn:hover::before {
    left: 100%;
}

.btn-primary {
    background: var(--gradient-primary);
    color: white;
    box-shadow: 0 4px 15px rgba(102, 102, 255, 0.25);
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 102, 255, 0.35);
}

.btn-secondary {
    background: var(--background-white);
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    box-shadow: 0 2px 10px var(--shadow-light);
}

.btn-secondary:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(102, 102, 255, 0.25);
}

.btn-large {
    padding: 16px 32px;
    font-size: 1.1rem;
    border-radius: 14px;
}

/* Header */
.main-header {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid var(--border-light);
    padding: 15px 0;
    position: sticky;
    top: 0;
    z-index: 1000;
    transition: all 0.3s ease;
    box-shadow: 0 2px 20px var(--shadow-light);
}

.main-header .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo a {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    font-family: 'Poppins', sans-serif;
    text-decoration: none;
    transition: all 0.3s ease;
}

.logo a:hover {
    transform: scale(1.05);
}

.main-nav ul {
    display: flex;
    list-style: none;
    align-items: center;
}

.main-nav ul li {
    margin-left: 2rem;
}

.main-nav ul li a {
    color: var(--text-primary);
    font-weight: 500;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 8px;
    transition: all 0.3s ease;
    position: relative;
}

.main-nav ul li a::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    width: 0;
    height: 2px;
    background: var(--primary-color);
    transition: all 0.3s ease;
    transform: translateX(-50%);
}

.main-nav ul li a:hover {
    color: var(--primary-color);
    background: rgba(99, 102, 241, 0.1);
}

.main-nav ul li a:hover::after {
    width: 100%;
}

/* Mobile Navigation */
.nav-toggle {
    display: none;
    background: transparent;
    border: none;
    cursor: pointer;
    padding: 10px;
    position: relative;
    z-index: 1001;
}

.nav-toggle .hamburger {
    display: block;
    width: 25px;
    height: 2px;
    background: var(--text-primary);
    position: relative;
    transition: all 0.3s ease;
    border-radius: 2px;
}

.nav-toggle .hamburger::before,
.nav-toggle .hamburger::after {
    content: '';
    position: absolute;
    width: 100%;
    height: 2px;
    background: var(--text-primary);
    transition: all 0.3s ease;
    border-radius: 2px;
}

.nav-toggle .hamburger::before {
    transform: translateY(-8px);
}

.nav-toggle .hamburger::after {
    transform: translateY(8px);
}

.nav-toggle.active .hamburger {
    background: transparent;
}

.nav-toggle.active .hamburger::before {
    transform: rotate(45deg);
}

.nav-toggle.active .hamburger::after {
    transform: rotate(-45deg);
}

/* Hero Section */
.hero-section {
    background: var(--gradient-primary);
    color: white;
    text-align: center;
    padding: 120px 0 80px;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.hero-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a"><stop offset="0" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="1" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="250" cy="250" r="150" fill="url(%23a)"/><circle cx="750" cy="750" r="200" fill="url(%23a)"/></svg>') no-repeat center center;
    background-size: cover;
    opacity: 0.6;
    animation: float 6s ease-in-out infinite;
}

.hero-content {
    position: relative;
    z-index: 2;
    max-width: 800px;
    margin: 0 auto;
    animation: fadeInUp 1s ease-out;
}

.hero-section .tagline {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    opacity: 1;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.95);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
    animation: fadeInUp 1s ease-out 0.2s both;
}

.hero-section h1 {
    font-size: 4rem;
    margin-bottom: 1.5rem;
    font-weight: 700;
    line-height: 1.1;
    color: #ffffff;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    animation: fadeInUp 1s ease-out 0.4s both;
}

.hero-section .subtitle {
    font-size: 1.3rem;
    margin-bottom: 2.5rem;
    opacity: 1;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    color: rgba(255, 255, 255, 0.9);
    text-shadow: 0 1px 4px rgba(0, 0, 0, 0.4);
    animation: fadeInUp 1s ease-out 0.6s both;
}

.hero-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    animation: fadeInUp 1s ease-out 0.8s both;
}

.hero-buttons .btn {
    min-width: 160px;
}

/* Floating Elements */
.floating-elements {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    overflow: hidden;
}

.floating-element {
    position: absolute;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    animation: float 8s ease-in-out infinite;
}

.floating-element:nth-child(1) {
    width: 80px;
    height: 80px;
    top: 20%;
    left: 10%;
    animation-delay: 0s;
}

.floating-element:nth-child(2) {
    width: 120px;
    height: 120px;
    top: 60%;
    right: 10%;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    top: 30%;
    right: 30%;
    animation-delay: 4s;
}

/* Features Section */
.features-section {
    padding: 100px 0;
    background: var(--background-white);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
}

.section-header h2 {
    color: var(--text-primary);
    margin-bottom: 1rem;
}

.section-header p {
    font-size: 1.2rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.feature-card {
    background: var(--card-background);
    padding: 2.5rem 2rem;
    border-radius: 20px;
    text-align: center;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--border-light);
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: 1;
}

.feature-card:hover::before {
    opacity: 0.05;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px var(--shadow-medium);
    border-color: var(--primary-color);
}

.feature-card > * {
    position: relative;
    z-index: 2;
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: white;
    transition: all 0.3s ease;
}

.feature-card:hover .feature-icon {
    transform: scale(1.1) rotate(5deg);
}

.feature-card h3 {
    margin-bottom: 1rem;
    color: var(--text-primary);
}

.feature-card p {
    color: var(--text-secondary);
    line-height: 1.6;
}

/* About Section */
.about-section {
    padding: 100px 0;
    background: var(--background-light);
}

.about-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.about-text h2 {
    margin-bottom: 1.5rem;
    color: var(--text-primary);
}

.about-text p {
    margin-bottom: 1.5rem;
    font-size: 1.1rem;
    line-height: 1.7;
}

.about-image {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px var(--shadow-medium);
}

.about-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: var(--gradient-accent);
    opacity: 0.8;
    z-index: 1;
}

.about-placeholder {
    width: 100%;
    height: 400px;
    background: var(--gradient-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    font-weight: 500;
    border-radius: 16px;
}

.gaming-stats {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 2rem;
    width: 100%;
    max-width: 350px;
    text-align: center;
}

.stat-item {
    padding: 1.5rem;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 12px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    animation: fadeInUp 0.6s ease-out forwards;
}

.stat-item:hover {
    transform: translateY(-5px);
    background: rgba(255, 255, 255, 0.25);
}

.stat-item:nth-child(1) { animation-delay: 0.1s; }
.stat-item:nth-child(2) { animation-delay: 0.2s; }
.stat-item:nth-child(3) { animation-delay: 0.3s; }
.stat-item:nth-child(4) { animation-delay: 0.4s; }

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: #ffffff;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

.stat-label {
    font-size: 0.9rem;
    font-weight: 500;
    color: rgba(255, 255, 255, 0.9);
    text-transform: uppercase;
    letter-spacing: 1px;
}

/* Blog Section */
.blog-section {
    padding: 100px 0;
    background: var(--background-white);
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
}

.blog-card {
    background: var(--card-background);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid var(--border-light);
    position: relative;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 50px var(--shadow-medium);
}

.blog-image {
    height: 200px;
    background: var(--gradient-secondary);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 500;
    position: relative;
    overflow: hidden;
}

.blog-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.2);
}

.blog-content {
    padding: 2rem;
}

.blog-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: var(--text-muted);
}

.blog-card h3 {
    margin-bottom: 1rem;
    color: var(--text-primary);
    font-size: 1.3rem;
}

.blog-card p {
    color: var(--text-secondary);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.read-more {
    color: var(--primary-color);
    text-decoration: none;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.read-more:hover {
    gap: 1rem;
}

/* Contact Section */
.contact-section {
    padding: 100px 0;
    background: var(--background-light);
}

.contact-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
}

.contact-info h3 {
    margin-bottom: 1.5rem;
    color: var(--text-primary);
}

.contact-info p {
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.7;
}

.contact-details {
    list-style: none;
}

.contact-details li {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    color: var(--text-secondary);
}

.contact-details li i {
    width: 20px;
    color: var(--primary-color);
}

.contact-form {
    background: var(--background-white);
    padding: 2.5rem;
    border-radius: 20px;
    box-shadow: 0 10px 30px var(--shadow-light);
    border: 1px solid var(--border-light);
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--text-primary);
    font-weight: 500;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 12px 16px;
    border: 2px solid var(--border-light);
    border-radius: 10px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: var(--background-white);
    color: var(--text-primary);
}

.form-group input:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-group textarea {
    height: 120px;
    resize: vertical;
}

/* Footer */
.main-footer {
    background: var(--text-primary);
    color: white;
    text-align: center;
    padding: 3rem 0 2rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 2rem;
}

.footer-section h4 {
    margin-bottom: 1rem;
    color: white;
}

.footer-section p,
.footer-section a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    line-height: 1.6;
}

.footer-section a:hover {
    color: var(--primary-color);
}

.social-links {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 1rem;
}

.social-links a {
    width: 40px;
    height: 40px;
    background: var(--primary-color);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    transition: all 0.3s ease;
}

.social-links a:hover {
    transform: translateY(-3px);
    background: var(--secondary-color);
}

.footer-bottom {
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    padding-top: 2rem;
    color: rgba(255, 255, 255, 0.6);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-section h1 { font-size: 3rem; }
    .about-content,
    .contact-content {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
}

@media (max-width: 768px) {
    .nav-toggle {
        display: block;
    }

    .main-nav {
        position: fixed;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100vh;
        background: var(--background-white);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: left 0.3s ease;
        z-index: 1000;
    }

    .main-nav.active {
        left: 0;
    }

    .main-nav ul {
        flex-direction: column;
        gap: 2rem;
    }

    .main-nav ul li {
        margin: 0;
    }

    .main-nav ul li a {
        font-size: 1.5rem;
        padding: 1rem 2rem;
    }

    .hero-section {
        padding: 80px 0 60px;
        text-align: center;
    }

    .hero-section h1 {
        font-size: 2.5rem;
    }

    .hero-buttons {
        flex-direction: column;
        align-items: center;
    }

    .features-grid,
    .blog-grid {
        grid-template-columns: 1fr;
    }

    .contact-form {
        padding: 2rem;
    }

    h1 { font-size: 2.5rem; }
    h2 { font-size: 2rem; }
    h3 { font-size: 1.5rem; }
}

@media (max-width: 480px) {
    .container {
        padding: 0 15px;
    }

    .hero-section {
        padding: 60px 0 40px;
    }

    .hero-section h1 {
        font-size: 2rem;
    }

    .hero-section .tagline,
    .hero-section .subtitle {
        font-size: 1rem;
    }

    .btn {
        padding: 10px 20px;
        font-size: 0.9rem;
    }

    .btn-large {
        padding: 12px 24px;
        font-size: 1rem;
    }

    .feature-card,
    .contact-form {
        padding: 1.5rem;
    }

    .section-header h2 {
        font-size: 1.8rem;
    }
}

/* Loading States */
.loading {
    opacity: 0.7;
    pointer-events: none;
}

.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    border: 2px solid var(--border-light);
    border-top: 2px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
    transform: translate(-50%, -50%);
}

/* Utility Classes */
.text-center { text-align: center; }
.text-left { text-align: left; }
.text-right { text-align: right; }

.mb-1 { margin-bottom: 0.5rem; }
.mb-2 { margin-bottom: 1rem; }
.mb-3 { margin-bottom: 1.5rem; }
.mb-4 { margin-bottom: 2rem; }

.mt-1 { margin-top: 0.5rem; }
.mt-2 { margin-top: 1rem; }
.mt-3 { margin-top: 1.5rem; }
.mt-4 { margin-top: 2rem; }

.fade-in {
    animation: fadeInUp 0.8s ease-out;
}

.slide-in-left {
    animation: fadeInLeft 0.8s ease-out;
}

.slide-in-right {
    animation: fadeInRight 0.8s ease-out;
}
</style>
</head>

<body>
    <!-- Page Loader -->
    <div class="page-loader" id="pageLoader">
        <div class="loader-content">
            <div class="loader-spinner"></div>
            <div class="loader-text">Loading SKVGamerz...</div>
        </div>
    </div>

    <!-- Header -->
    <header class="main-header">
        <div class="container">
            <div class="logo">
                <a href="#home">SKVGamerz</a>
            </div>
            <nav class="main-nav" id="mainNav">
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#blog">Blog</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <button class="nav-toggle" id="navToggle">
                <span class="hamburger"></span>
            </button>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
        <div class="container">
            <div class="hero-content">
                <p class="tagline">Welcome to the Future of Gaming</p>
                <h1>Level Up Your Gaming Experience</h1>
                <p class="subtitle">Discover the latest games, expert reviews, and gaming tips. Your ultimate destination for everything gaming - from mobile to PC, from indie gems to AAA blockbusters.</p>
                <div class="hero-buttons">
                    <a href="#features" class="btn btn-primary btn-large">Explore Games</a>
                    <a href="#blog" class="btn btn-secondary btn-large">Latest Reviews</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header reveal">
                <h2>What We Offer</h2>
                <p>Everything you need to stay ahead in the gaming world</p>
            </div>
            <div class="features-grid">
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Mobile Gaming</h3>
                    <p>Discover the best Android games, from casual puzzlers to hardcore action titles. Get the latest APKs and gaming tips.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-desktop"></i>
                    </div>
                    <h3>PC Gaming</h3>
                    <p>Comprehensive PC game reviews, system requirements, and optimization guides to get the most out of your gaming rig.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <h3>Emulators</h3>
                    <p>Best gaming emulators for retro gaming experiences. Play classic console games on modern devices with our expert guides.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Game Reviews</h3>
                    <p>Honest, in-depth game reviews from experienced gamers. Make informed decisions before your next gaming purchase.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Gaming Community</h3>
                    <p>Join our vibrant community of gamers. Share experiences, get tips, and connect with fellow gaming enthusiasts.</p>
                </div>
                <div class="feature-card reveal">
                    <div class="feature-icon">
                        <i class="fas fa-download"></i>
                    </div>
                    <h3>Game Downloads</h3>
                    <p>Safe and secure game downloads with detailed installation guides and troubleshooting support.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text reveal slide-in-left">
                    <h2>About SKVGamerz</h2>
                    <p>SKVGamerz has been at the forefront of gaming content for years, providing gamers with the latest news, reviews, and downloadable content. Our mission is to create a comprehensive platform where gaming enthusiasts can find everything they need.</p>
                    <p>From the latest mobile games to classic PC titles, from detailed reviews to quick gaming tips, we cover it all. Our team of passionate gamers works tirelessly to bring you authentic, helpful content that enhances your gaming journey.</p>
                    <p>Whether you're a casual gamer or a hardcore enthusiast, SKVGamerz is your trusted companion in the ever-evolving world of gaming.</p>
                    <a href="#contact" class="btn btn-primary">Get In Touch</a>
                </div>
                <div class="about-image reveal slide-in-right">
                    <div class="about-placeholder">
                        <div class="gaming-stats">
                            <div class="stat-item">
                                <div class="stat-number">1000+</div>
                                <div class="stat-label">Game Reviews</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">50K+</div>
                                <div class="stat-label">Happy Gamers</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">24/7</div>
                                <div class="stat-label">Gaming Support</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">5+</div>
                                <div class="stat-label">Years Experience</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="blog-section">
        <div class="container">
            <div class="section-header reveal">
                <h2>Latest Gaming Content</h2>
                <p>Stay updated with our latest reviews, news, and gaming guides</p>
            </div>
            <div class="blog-grid" id="blogContainer">
                <!-- Blog posts will be loaded here via JavaScript -->
                <div class="blog-card reveal">
                    <div class="blog-image">Featured Gaming Content</div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> Recent</span>
                            <span><i class="fas fa-tag"></i> Gaming</span>
                        </div>
                        <h3>Loading Latest Content...</h3>
                        <p>Our latest gaming content is being loaded. Check back soon for the newest reviews, guides, and gaming news.</p>
                        <a href="#" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
        <div class="container">
            <div class="section-header reveal">
                <h2>Get In Touch</h2>
                <p>Have questions or suggestions? We'd love to hear from you!</p>
            </div>
            <div class="contact-content">
                <div class="contact-info reveal slide-in-left">
                    <h3>Contact Information</h3>
                    <p>Ready to level up your gaming experience? Get in touch with our team for gaming recommendations, technical support, or just to share your gaming achievements!</p>
                    <ul class="contact-details">
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>contact@skvgamerz.com</span>
                        </li>
                        <li>
                            <i class="fas fa-globe"></i>
                            <span>www.skvgamerz.com</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>24/7 Gaming Support</span>
                        </li>
                        <li>
                            <i class="fas fa-gamepad"></i>
                            <span>All Gaming Platforms</span>
                        </li>
                    </ul>
                </div>
                <div class="contact-form reveal slide-in-right">
                    <form id="contactForm" method="POST" action="">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary btn-large">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h4>SKVGamerz</h4>
                    <p>Your ultimate destination for gaming content, reviews, and downloads. Level up your gaming experience with us!</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                        <a href="#"><i class="fab fa-discord"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <p><a href="#home">Home</a></p>
                    <p><a href="#features">Features</a></p>
                    <p><a href="#about">About</a></p>
                    <p><a href="#blog">Blog</a></p>
                    <p><a href="#contact">Contact</a></p>
                </div>
                <div class="footer-section">
                    <h4>Gaming Categories</h4>
                    <p><a href="#">Mobile Games</a></p>
                    <p><a href="#">PC Games</a></p>
                    <p><a href="#">Emulators</a></p>
                    <p><a href="#">Game Reviews</a></p>
                    <p><a href="#">Gaming Tips</a></p>
                </div>
                <div class="footer-section">
                    <h4>Support</h4>
                    <p><a href="#">Help Center</a></p>
                    <p><a href="#">Download Support</a></p>
                    <p><a href="#">Technical Issues</a></p>
                    <p><a href="#">Community Forum</a></p>
                    <p><a href="#">Contact Support</a></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> SKVGamerz. All rights reserved. | Made with ❤️ for gamers worldwide</p>
            </div>
        </div>
    </footer>

<script>
// Enhanced JavaScript for Modern Interactions

// Page Loader
window.addEventListener('load', function() {
    const loader = document.getElementById('pageLoader');
    setTimeout(() => {
        loader.classList.add('hidden');
    }, 1000);
});

// Mobile Navigation Toggle
const navToggle = document.getElementById('navToggle');
const mainNav = document.getElementById('mainNav');

navToggle.addEventListener('click', function() {
    navToggle.classList.toggle('active');
    mainNav.classList.toggle('active');
    document.body.style.overflow = mainNav.classList.contains('active') ? 'hidden' : '';
});

// Close mobile nav when clicking on a link
document.querySelectorAll('.main-nav a').forEach(link => {
    link.addEventListener('click', function() {
        navToggle.classList.remove('active');
        mainNav.classList.remove('active');
        document.body.style.overflow = '';
    });
});

// Smooth Scrolling for Navigation Links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        const href = this.getAttribute('href');
        if (href && href !== '#') {
            const target = document.querySelector(href);
            if (target) {
                const headerHeight = document.querySelector('.main-header').offsetHeight;
                const targetPosition = target.offsetTop - headerHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        }
    });
});

// Header Scroll Effect
let lastScrollTop = 0;
const header = document.querySelector('.main-header');

window.addEventListener('scroll', function() {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    
    if (scrollTop > 100) {
        header.style.background = 'rgba(255, 255, 255, 0.98)';
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.1)';
    } else {
        header.style.background = 'rgba(255, 255, 255, 0.95)';
        header.style.boxShadow = '0 2px 20px rgba(0, 0, 0, 0.04)';
    }
    
    lastScrollTop = scrollTop;
});

// Reveal Animation on Scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('active');
        }
    });
}, observerOptions);

// Observe all reveal elements
document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
});

// Enhanced Button Click Effects
document.querySelectorAll('.btn').forEach(button => {
    button.addEventListener('click', function(e) {
        // Create ripple effect
        const ripple = document.createElement('span');
        const rect = button.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.cssText = `
            position: absolute;
            width: ${size}px;
            height: ${size}px;
            left: ${x}px;
            top: ${y}px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple 0.6s linear;
            pointer-events: none;
        `;
        
        button.style.position = 'relative';
        button.style.overflow = 'hidden';
        button.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});

// Contact Form Handling
const contactForm = document.getElementById('contactForm');
if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const submitButton = this.querySelector('button[type="submit"]');
        const originalText = submitButton.textContent;
        
        // Add loading state
        submitButton.textContent = 'Sending...';
        submitButton.disabled = true;
        submitButton.classList.add('loading');
        
        // Simulate form submission (replace with actual form handling)
        setTimeout(() => {
            // Reset form
            this.reset();
            
            // Show success message
            submitButton.textContent = 'Message Sent!';
            submitButton.style.background = 'linear-gradient(135deg, #34d399, #10b981)';
            
            // Reset button after 3 seconds
            setTimeout(() => {
                submitButton.textContent = originalText;
                submitButton.disabled = false;
                submitButton.classList.remove('loading');
                submitButton.style.background = '';
            }, 3000);
        }, 1500);
    });
}

// Enhanced RSS Feed Loading for Blog Section
async function loadBlogPosts() {
    const blogContainer = document.getElementById('blogContainer');
    
    try {
        // Show loading state
        blogContainer.innerHTML = `
            <div class="blog-card reveal">
                <div class="blog-image">Loading...</div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fas fa-spinner fa-spin"></i> Loading</span>
                    </div>
                    <h3>Fetching Latest Content...</h3>
                    <p>Please wait while we load the latest gaming content for you.</p>
                </div>
            </div>
        `;
        
        // Fetch RSS feed through PHP proxy
        const response = await fetch('?get_feed=true');
        
        if (!response.ok) {
            throw new Error('Failed to fetch RSS feed');
        }
        
        const xmlText = await response.text();
        const parser = new DOMParser();
        const xmlDoc = parser.parseFromString(xmlText, 'text/xml');
        
        // Parse RSS items
        const items = xmlDoc.querySelectorAll('item');
        let blogHTML = '';
        
        // Limit to 6 posts for better layout
        const maxPosts = Math.min(items.length, 6);
        
        for (let i = 0; i < maxPosts; i++) {
            const item = items[i];
            const title = item.querySelector('title')?.textContent || 'Gaming Article';
            const description = item.querySelector('description')?.textContent || 'Exciting gaming content awaits you.';
            const link = item.querySelector('link')?.textContent || '#';
            const pubDate = item.querySelector('pubDate')?.textContent || '';
            
            // Extract image from description content
            let imageUrl = '';
            if (description) {
                const imgMatch = description.match(/<img[^>]+src="([^">]+)"/);
                if (imgMatch && imgMatch[1]) {
                    imageUrl = imgMatch[1];
                }
            }
            
            // Clean up description (remove HTML tags and limit length)
            const cleanDescription = description.replace(/<[^>]*>/g, '').substring(0, 150) + '...';
            
            // Format date
            const formatDate = (dateString) => {
                if (!dateString) return 'Recent';
                const date = new Date(dateString);
                return date.toLocaleDateString('en-US', { 
                    year: 'numeric', 
                    month: 'short', 
                    day: 'numeric' 
                });
            };
            
            // Create image content - use actual image if available, otherwise fallback to icon
            const imageContent = imageUrl ? 
                `<img src="${imageUrl}" alt="${title}" style="width: 100%; height: 100%; object-fit: cover;">` :
                `<i class="fas fa-gamepad" style="font-size: 2rem;"></i>`;
            
            blogHTML += `
                <div class="blog-card reveal">
                    <div class="blog-image">
                        ${imageContent}
                    </div>
                    <div class="blog-content">
                        <div class="blog-meta">
                            <span><i class="fas fa-calendar"></i> ${formatDate(pubDate)}</span>
                            <span><i class="fas fa-tag"></i> Gaming</span>
                        </div>
                        <h3>${title}</h3>
                        <p>${cleanDescription}</p>
                        <a href="${link}" target="_blank" class="read-more">
                            Read More <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            `;
        }
        
        blogContainer.innerHTML = blogHTML;
        
        // Re-observe new elements for reveal animation
        blogContainer.querySelectorAll('.reveal').forEach(el => {
            observer.observe(el);
        });
        
    } catch (error) {
        console.error('Error loading blog posts:', error);
        blogContainer.innerHTML = `
            <div class="blog-card reveal">
                <div class="blog-image" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);">
                    <i class="fas fa-exclamation-triangle" style="font-size: 2rem;"></i>
                </div>
                <div class="blog-content">
                    <div class="blog-meta">
                        <span><i class="fas fa-info-circle"></i> Notice</span>
                    </div>
                    <h3>Content Loading Issue</h3>
                    <p>We're experiencing some difficulty loading the latest content. Please check back later or visit our main blog for the newest gaming articles and reviews.</p>
                    <a href="https://skvgamerzyt.blogspot.com" target="_blank" class="read-more">
                        Visit Blog <i class="fas fa-external-link-alt"></i>
                    </a>
                </div>
            </div>
        `;
    }
}

// Load blog posts when page is ready
document.addEventListener('DOMContentLoaded', function() {
    // Add a small delay to ensure smooth loading experience
    setTimeout(loadBlogPosts, 1500);
});

// Parallax Effect for Hero Section
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('.floating-element');
    
    parallaxElements.forEach((element, index) => {
        const speed = 0.5 + (index * 0.1);
        element.style.transform = `translateY(${scrolled * speed}px)`;
    });
});

// Keyboard Navigation Support
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        // Close mobile navigation
        navToggle.classList.remove('active');
        mainNav.classList.remove('active');
        document.body.style.overflow = '';
    }
});

// Performance Optimization: Throttle scroll events
function throttle(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Apply throttling to scroll events
const throttledScrollHandler = throttle(function() {
    // Any scroll-intensive functions can be placed here
}, 16); // ~60fps

window.addEventListener('scroll', throttledScrollHandler);

// Add loading animation to images
document.querySelectorAll('img').forEach(img => {
    img.addEventListener('load', function() {
        this.style.opacity = '1';
    });
});

console.log('🎮 SKVGamerz website loaded successfully! Level up your gaming experience!');
</script>

</body>
</html>
