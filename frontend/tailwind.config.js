/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        'brand-primary': '#d32f2f',
        'brand-primary-dark': '#b71c1c',
        'brand-secondary': '#2e7d32',
        'brand-light': '#f5f5f5',
        'brand-dark': '#333',
        'brand-gray': '#666',
        'brand-light-gray': '#e0e0e0',
        'brand-accent': '#f59e0b',
        'brand-cream': '#fff7e6'
      },
      boxShadow: {
        'brand': '0 8px 25px rgba(0, 0, 0, 0.15)',
        'brand-hover': '0 8px 20px rgba(0,0,0,0.12)',
      },
      fontFamily: {
        'sans': ['Segoe UI', 'Tahoma', 'Geneva', 'Verdana', 'sans-serif'],
      },
    },
  },
  plugins: [],
}