/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php", "./assets/js/**/*.js"],
  safelist: [
    "is-active", "menu-open", "chat-open",
    "!opacity-100", "opacity-0", "w-5", "w-1.5", "bg-aur-blue", "bg-aur-line",
  ],
  theme: {
    extend: {
      colors: {
        aur: {
          ink:      "#0A0E1A",
          base:     "#0C1322",
          surface:  "#121A2E",
          elevated: "#18233D",
          line:     "#28324F",
          blue:     "#3D7BFF",
          blueDim:  "#2B5FD9",
          violet:   "#9B5CFF",
          cyan:     "#2BD6F0",
          amber:    "#FFB23E",
          pink:     "#FF5C9A",
          paper:    "#EAF1FF",
          muted:    "#94A3C4",
        },
      },
      fontFamily: {
        display: ['"Space Grotesk"', 'system-ui', 'sans-serif'],
        body: ['Inter', 'system-ui', 'sans-serif'],
        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
      },
      boxShadow: {
        glow: "0 10px 40px -10px rgba(61,123,255,.55)",
        glowV: "0 10px 40px -10px rgba(155,92,255,.5)",
        card: "0 24px 60px -28px rgba(0,0,0,.75)",
        soft: "0 8px 30px -12px rgba(0,0,0,.5)",
      },
      backgroundImage: {
        "aurora": "linear-gradient(120deg,#3D7BFF 0%,#9B5CFF 55%,#2BD6F0 100%)",
        "aurora-soft": "linear-gradient(120deg,rgba(61,123,255,.18),rgba(155,92,255,.16),rgba(43,214,240,.14))",
        "grid": "linear-gradient(rgba(255,255,255,.035) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.035) 1px,transparent 1px)",
      },
      backgroundSize: { "grid": "46px 46px" },
      keyframes: {
        riseIn: { "0%": { opacity: 0, transform: "translateY(22px)" }, "100%": { opacity: 1, transform: "translateY(0)" } },
        floaty: { "0%,100%": { transform: "translateY(0)" }, "50%": { transform: "translateY(-8px)" } },
        shimmer: { "0%": { backgroundPosition: "0% 50%" }, "100%": { backgroundPosition: "200% 50%" } },
      },
      animation: {
        riseIn: "riseIn .7s cubic-bezier(.16,1,.3,1) both",
        floaty: "floaty 6s ease-in-out infinite",
        shimmer: "shimmer 6s linear infinite",
      },
    },
  },
  plugins: [],
};
