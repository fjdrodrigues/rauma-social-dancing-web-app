import { Component } from '@angular/core';
import { GalleryItem, GalleryItemType } from '../../shared/gallery/gallery-item.interface';

@Component({
  selector: 'cuban-salsa-dance',
  templateUrl: './cuban-salsa-dance.component.html',
  styleUrls: ['./cuban-salsa-dance.component.css']
})
export class CubanSalsaDanceComponent {
	
  public cubanSalsaVideos: Array<GalleryItem> = [
		{
			itemType: GalleryItemType.video,
			url: "5CLqh-pPzwQ",
			title: "Cuban Salsa",
			description: "Adonis Santiago & Cristina Bolbat"
		},
		{
			itemType: GalleryItemType.video,
			url: "M8XlkjUM00U",
			title: "Cuban Salsa",
			description: "Jonar Gonzalez & Pamela Brillet"
		},
		{
			itemType: GalleryItemType.video,
			url: "K9ffbbWJ2eY",
			title: "Cuban Salsa",
			description: "Lisandra & Victor"
		},
		{
			itemType: GalleryItemType.video,
			url: "_-GCRvTC5zk",
			title: "Cuban Salsa",
			description: "Osmani Segura & Desiree"
		},
		{
			itemType: GalleryItemType.video,
			url: "ECYWTfgGzlY",
			title: "Cuban Salsa",
			description: "Osbanis & Anneta"
		},
		{
			itemType: GalleryItemType.video,
			url: "U1WgrUQ1rJo",
			title: "Cuban Salsa",
			description: "Osbanis & Anneta"
		}
	];
  constructor() {
  }
	
}
