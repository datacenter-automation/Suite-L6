module.exports = {
  prefix: 'tw-',
  theme: {
    fontFamily: {
      sans: [
        'Source Sans Pro',
        '-apple-system',
        'BlinkMacSystemFont',
        '"Segoe UI"',
        'Roboto',
        '"Helvetica Neue"',
        'Arial',
        '"Noto Sans"',
        'sans-serif',
        '"Apple Color Emoji"',
        '"Segoe UI Emoji"',
        '"Segoe UI Symbol"',
        '"Noto Color Emoji"',
      ],
      serif: [
        'Source Sans Pro',
        'Georgia',
        'Cambria',
        '"Times New Roman"',
        'Times',
        'serif',
      ],
      mono: [
        'Menlo',
        'Monaco',
        'Consolas',
        '"Liberation Mono"',
        '"Courier New"',
        'monospace',
      ],
    },
  },
  variants: {},
  plugins: [
    require('@tailwindcss/custom-forms'),
    require('tailwindcss-accessibility'),
    require('tailwindcss-aspect-ratio'),
    require('tailwindcss-children'),
    require('tailwindcss-gap'),
    require('tailwindcss-multi-column'),
    require('tailwindcss-touch'),
    require('tailwindcss-visuallyhidden'),
]
}
