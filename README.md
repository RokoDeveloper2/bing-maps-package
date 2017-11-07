[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/BingMaps/functions?utm_source=RapidAPIGitHub_BingMapsFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# BingMaps Package
The Bing Maps APIs include map controls and services that you can use to incorporate Bing Maps in applications and websites. In addition to interactive and static maps, the APIs provide access to other geospatial features such as geocoding, route and traffic data and spatial data sources that you can use to store and query data that has a spatial component, such as store locations.
* Domain: [bing.com/maps](https://www.bing.com/maps)
* Credentials: key

## How to get credentials: 
1. Sign in [portal.azure.com](https://portal.azure.com).
2. Add new API subscription.
 
## BingMaps.findLocationByAddress
Get latitude and longitude coordinates for a location by specifying values such as a locality, postal code, and street address.

| Field              | Type       | Description
|--------------------|------------|----------
| key                | credentials| Your API key
| adminDistrict      | String     | The subdivision name in the country or region for an address. This element is typically treated as the first order administrative subdivision, but in some cases it is the second, third, or fourth order subdivision in a country, dependency, or region. Example: WA
| locality           | String     | The locality, such as the city or neighborhood, that corresponds to an address. Example: Seattle
| postalCode         | String     | The post code, postal code, or ZIP Code of an address. Example: 98178
| addressLine        | String     | The official street line of an address relative to the area, as specified by the Locality, or PostalCode, properties. Typical use of this element would be to provide a street address or any official address. Example: 1 Microsoft Way
| countryRegion      | String     | The ISO country code for the country. Example: AU
| includeNeighborhood| Select     | One of the following values: 1: Include neighborhood information when available.0 [default]: Do not include neighborhood information.
| include            | Select     | The only value for this parameter is ciso2. When you specify include=ciso2, the two-letter ISO country code is included for addresses in the response.
| maxResults         | Number     | Specifies the maximum number of locations to return in the response. A string that contains an integer between 1 and 20. The default value is 5.

## BingMaps.findLocationByPoint
Use the following URL template to get the location information associated with latitude and longitude coordinates.

| Field              | Type       | Description
|--------------------|------------|----------
| key                | credentials| Your API key
| includeEntityTypes | List       | Specifies the entity types that you want to return in the response. Only the types you specify will be returned. If the point cannot be mapped to the entity types you specify, no location information is returned in the response.
| point              | Map        | A point on the Earth specified by a latitude and longitude. Example: 47.64054,-122.12934
| includeNeighborhood| Select     | Specifies to include the neighborhood in the response when it is available.
| include            | Select     | The only value for this parameter is ciso2. When you specify include=ciso2, the two-letter ISO country code is included for addresses in the response.

## BingMaps.findLocationByQuery
Use the following URL templates to get latitude and longitude coordinates that correspond to location information provided as a query string.

| Field              | Type       | Description
|--------------------|------------|----------
| key                | credentials| Your API key
| query              | String     | A point on the Earth specified by a latitude and longitude. Example: 47.64054,-122.12934
| includeNeighborhood| Select     | Specifies to include the neighborhood in the response when it is available.
| include            | Select     | The only value for this parameter is ciso2. When you specify include=ciso2, the two-letter ISO country code is included for addresses in the response.
| maxResults         | Number     | Specifies the maximum number of locations to return in the response.

## BingMaps.getElevationValues
Get elevation values (in meters) for a set of locations, a polyline path or area on the Earth.

| Field  | Type       | Description
|--------|------------|----------
| key    | credentials| Your API key
| points | List       | A set of coordinates on the Earth to use in elevation calculations. The exact use of these points depends on the type of elevation request. Example: [35.89431,-110.72522,35.89393,-110.72578,35.89374]
| bounds | String     | Specifies the rectangular area over which to provide elevation values. A bounding box defined as a set of WGS84 latitudes and longitudes in the following order: south latitude, west longitude, north latitude, east longitude. Example: bounds=45.219,-122.234,47.61,-122.07
| rows   | Number     |  Specifies the number of rows and columns to use to divide the bounding box area into a grid. The rows and columns that define the bounding box each count as two (2) of the rows and columns. Elevation values are returned for all vertices of the grid.
| cols   | Number     |  Specifies the number of rows and columns to use to divide the bounding box area into a grid. The rows and columns that define the bounding box each count as two (2) of the rows and columns. Elevation values are returned for all vertices of the grid.
| samples| Number     | Specifies the number of equally-spaced elevation values to provide along a polyline path.
| heights| String     | Specifies which sea level model to use to calculate elevation.

## BingMaps.getStaticMap
Get a static map. You can also display a route on a static map, and you can request static map metadata. Static map metadata includes the absolute (latitude and longitude) and relative (with respect to the map) coordinates and size of pushpins as well as the map area and center point.

| Field          | Type       | Description
|----------------|------------|----------
| key            | credentials| Your API key
| query    | String        | A query string that is used to determine the map location to display.
| mapLayer    | String        | A display layer that renders on top of the imagery set. Must be: TrafficFlow
| zoomLevel    | Number| The level of zoom to display. An integer between 0 and 21.

## BingMaps.getImageryMetadata
Get metadata for imagery that is hosted by Bing Maps. The imagery metadata returned includes URLs and dimensions for imagery tiles, ranges of zoom levels, and imagery vintage information.

| Field      | Type       | Description
|------------|------------|----------
| key        | credentials| Your API key
| imagerySet | Select     | The type of imagery for which you are requesting metadata. Must be: Aerial - Aerial imagery.          AerialWithLabels - Aerial imagery with a road overlay. Birdseye - Bird’s eye (oblique-angle) imagery. AerialWithLabelsOnDemand. BirdseyeWithLabels - Bird’s eye imagery with a road overlay. BirdseyeV2 - The second generation Bird’s eye (oblique-angle) imagery. BirdseyeV2WithLabels - The second generation Bird’s eye (oblique-angle) imagerywith a road overlay. CanvasDark - A dark version of the road maps. CanvasLight - A lighter version of the road maps which also has some of the details such as hill shading disabled. CanvasGray - A grayscale version of the road maps. Road - Roads without additional imagery. Uses the legacy static tile service. RoadOnDemand - Roads without additional imagery. Uses the dynamic tile service. OrdnanceSurvey - Ordnance Survey imagery. This imagery is visible only for the London area.
| centerPoint| Map        | A point on the Earth where the map is centered. Example: centerPoint=47.610,-122.107
| include    | Select     | Specifies to provide additional information about the imagery as part of the response. The only option for this parameter is ImageryProviders. When this parameter value is specified, information about the imagery providers is returned in the response.
| orientation| Number     | The orientation of the viewport to use for the imagery metadata. This option only applies to Birdseye imagery.
| uriScheme  | Select     | Specifies the scheme that image URL in the response should use. Musy be http or https
| zoomLevel  | Number     | The level of zoom to use for the imagery metadata.

## BingMaps.calculateRoute
Get a walking, driving or transit route by specifying a series of waypoints. A waypoint is a specified geographical location defined by longitude and latitude that is used for navigational purposes. The route includes information such as route instructions, travel duration, travel distance or transit information.

| Field                  | Type       | Description
|------------------------|------------|----------
| key                    | credentials| Your API key
| waypoints              | List       | Specifies two or more locations that define the route and that are in sequential order.
| avoid                  | Select     | Specifies the road types to minimize or avoid when a route is created for the driving travel mode.
| distanceBeforeFirstTurn| Number     | Specifies the distance before the first turn is allowed in the route. This option only applies to the driving travel mode.
| heading                | Number     | Specifies the initial heading for the route.
| optimize               | Select     | Specifies what parameters to use to optimize the route. Must be: distance,time,timeWithTraffic,timeAvoidClosure
| routeAttributes        | Select     | Specify to include or exclude parts of the routes response.
| routePathOutput        | Select     | Specifies whether the response should include information about Point (latitude and longitude) values for the route’s path. Must be: Points, None
| tolerances             | List       | Specifies a series of tolerance values. Each value produces a subset of points that approximates the route that is described by the full set of points. A set of comma-separated double values. 
| distanceUnit           | Select     | The units to use for distance in the response. Must be: mi, km
| dateTime               | DatePicker | A string that contains the date and time formatted as a DateTime value. 
| timeType               | Select     | Specifies how to interpret the date and transit time value that is specified by the dateTime parameter. Must be: Arrival, Departure, LastAvailable
| maxSolutions           | Number     | Specifies the maximum number of transit or driving routes to return.
| travelMode             | String     | One of the following values: Driving, Walking, Transit

## BingMaps.calculateRouteFromMajorRoads
Return a driving route to a location from major roads in four directions (West, North, East and South). You can use this block for routes in the United States, Canada and Mexico.

| Field          | Type       | Description
|----------------|------------|----------
| key            | credentials| Your API key
| destination    | Map        | Specifies the final location for all the routes.
| exclude        | Select     | Specifies to return only starting points for each major route in the response. When this option is not specified, detailed directions for each route are returned. The only value for this parameter is routes.
| routeAttributes| Select     | Specify to include or exclude parts of the routes response. Must be: excludeItinerary, routePath
| routePathOutput| Select     |  Specifies whether the response should include information about Point (latitude and longitude) values for each route’s path. Must be: Points, None
| distanceUnit   | Select     | The units to use for distance. Must be: mi, km
