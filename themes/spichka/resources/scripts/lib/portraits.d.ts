export type ThemeOptionsResponse = {
  theme_portraits: {
    static_image: string;
    alt: string;
    extra_images: {extra_image: string}[];
    quotes: {quote: string}[];
  }[];
};

export type Combination = {
  extraImage: string;
  quote: string;
};

export type Portrait = {
  staticImage: string;
  alt: string;
  combinations: Combination[];
};
