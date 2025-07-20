# SKVGamerz Homepage Project

## Overview

A modern, clean homepage built with HTML, CSS, and PHP. Features a light/pastel design theme with smooth animations and responsive UI/UX design. All functionality is delivered in a single PHP file for simplicity.

## User Preferences

- Communication style: Simple, everyday language  
- Design preference: Light/pastel color schemes instead of dark gaming themes
- Single file delivery: All functionality in one PHP file
- Focus on readability and clean design

## System Architecture

**Technology Stack:**
- PHP 8.2 (server-side functionality)
- HTML5/CSS3/JavaScript (frontend)
- Single file architecture: index.php

**Key Features:**
- Modern light theme with soft pastels (indigo, pink, emerald)
- Smooth CSS animations and reveal effects
- PHP RSS feed proxy functionality 
- Responsive design with mobile navigation
- Homepage sections: Hero, Features, About, Blog, Contact

## Recent Changes (July 20, 2025)

✓ Created modern homepage with light/pastel design theme
✓ Implemented PHP server with proper language installation  
✓ Fixed text contrast issues in hero section for better readability
✓ Resolved JavaScript querySelector errors for smooth navigation
✓ Added proper validation for anchor link navigation
✓ Enhanced blog section to extract and display actual images from RSS feed
✓ Successfully integrated real blog content with proper image display
✓ User confirmed homepage is working perfectly ("Super")

## Key Components

- **Header**: Sticky navigation with backdrop blur effect
- **Hero Section**: Gradient background with animated text and floating elements  
- **Features Grid**: Interactive cards with hover animations
- **About Section**: Two-column layout with placeholder content
- **Blog Section**: RSS feed integration with PHP proxy
- **Contact Form**: Functional contact form with animations
- **Mobile Navigation**: Responsive hamburger menu

## Data Flow

1. PHP handles RSS feed proxy requests (?get_feed=true)
2. Frontend JavaScript manages animations and interactions
3. CSS handles responsive design and visual effects
4. Single-file architecture keeps everything contained

## External Dependencies

- Google Fonts: Inter & Poppins font families
- Font Awesome 6.0 for icons
- No package managers needed - all delivered via CDN

## Deployment Strategy

- Runs on PHP 8.2 development server
- Single file deployment (index.php)
- Serves on port 5000 for Replit compatibility
- No database required for basic functionality