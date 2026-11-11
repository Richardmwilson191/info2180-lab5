document.addEventListener('DOMContentLoaded', function () {
  const lookup = document.getElementById('lookup')
  const result = document.getElementById('result')
  const searchInput = document.getElementById('country')

  const searchCountries = async () => {
    const searchText = searchInput.value.trim()
    const params = new URLSearchParams({ country: searchText })

    const response = await fetchData(params)
    result.innerHTML = response
  }

  lookup.addEventListener('click', searchCountries)

  searchInput.addEventListener('keydown', (event) => {
    if (event.key === 'Enter') {
      searchCountries()
    }
  })
})

async function fetchData(params) {
  try {
    const response = await fetch(
      `http://localhost/info2180-lab5/world.php?${params.toString()}`,
    )
    if (!response.ok) {
      throw new Error(`HTTP error! status: ${response.status}`)
    }
    const data = await response.text()
    return data
  } catch (error) {
    console.error('Error fetching data:', error)
  }
}
