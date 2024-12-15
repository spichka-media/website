
export const getHeadlinersData = async () => {
  try {
      const response = await fetch('/wp-json/custom-fields/theme_options');
      if (!response.ok) {
          console.error(`HTTP error! Status: ${response.status}`);
          return null;
      }
      const data = await response.json();
      return data;
  } catch (error) {
      console.error('Fetch error:', error);
      return null;
  }
}
